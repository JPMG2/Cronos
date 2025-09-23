<?php

declare(strict_types=1);

namespace App\Classes\Services\QueryPerson;

use DB;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * Generic readonly class PersonSearchService
 *
 * This class provides methods for querying person-related models (Medical, Patient, etc.)
 * with filters, relationships, and ordering. It adapts to different model structures
 * while maintaining a consistent interface.
 */
final readonly class PersonSearchService
{
    private Model $model;

    private bool $order;

    private string $orderDirection;

    private ?string $clickColumn;

    private array $searchableFields;

    private array $pivotRelations;

    /**
     * Constructs a new instance and initializes the provided attributes.
     *
     * @param Model       $model            The model instance to be used.
     * @param bool        $order            Determines the order direction.
     * @param string|null $clickColumn      Specifies the column to be clicked, if any.
     * @param array       $searchableFields Configuration array defining searchable fields.
     * @param array       $pivotRelations   Array of relations that use pivot tables.
     */
    public function __construct(
        Model $model,
        bool $order,
        ?string $clickColumn,
        array $searchableFields = [],
        array $pivotRelations = []
    ) {
        $this->model = $model;
        $this->order = $order;
        $this->clickColumn = $clickColumn;
        $this->searchableFields = $this->mergeWithDefaults($searchableFields);
        $this->pivotRelations = $pivotRelations;
        $this->iniOrder();
    }

    /**
     * Retrieves a filtered and ordered list of records based on the provided conditions.
     *
     * @param  array $filterConditions An array of column filtering conditions.
     * @return EloquentBuilder A query builder instance with applied filters, sorting, and relationships.
     */
    public function listSearch(array $filterConditions): EloquentBuilder
    {
        $query = $this->model->newQuery();

        if (! is_null($this->clickColumn)) {
            $this->orderColumnBy($query);
        }

        if (array_filter($filterConditions, fn ($v): bool => $v !== '') !== []) {
            $nonEmptyValues = array_filter($filterConditions);

            foreach ($nonEmptyValues as $key => $value) {
                if (array_key_exists($key, $this->pivotRelations)) {
                    $query = $this->createQueryPivot($query, $this->pivotRelations[$key], $value);
                } else {
                    $tableName = $this->tableName($key);
                    $indexName = $this->indexName($tableName);

                    if (is_string($tableName)
                        && is_string($indexName)
                        && $tableName !== ''
                        && $indexName !== ''
                    ) {
                        $query = $this->createQuery($query, $tableName, $indexName, $key, $value);
                    }
                }
            }

            return $this->getQueryDetails($query);
        }

        return $this->getQueryDetails($query);
    }

    /**
     * Retrieves the query details with aggregate data, ordering, and related relationships.
     *
     * @param  EloquentBuilder $query The base query to modify.
     * @return EloquentBuilder The modified query with aggregates, order, and relationships.
     */
    public function getQueryDetails(EloquentBuilder $query): EloquentBuilder
    {
        return $query->withAggregate('person', 'person_name')
            ->orderBy('person_person_name', $this->orderDirection)
            ->with($this->model::getRelationModel());
    }

    /**
     * Merges provided searchable fields with default person fields.
     *
     * @param  array $customFields Custom searchable fields configuration.
     * @return array The merged searchable fields.
     */
    private function mergeWithDefaults(array $customFields): array
    {
        $defaults = [
            'person' => 'person_name,person_lastname,num_document,person_email,person_phone',
        ];

        return array_merge($defaults, $customFields);
    }

    /**
     * Initializes the order direction based on the current order state.
     */
    private function iniOrder(): void
    {
        $this->orderDirection = $this->order ? 'asc' : 'desc';
    }

    /**
     * Orders the query results by a specific column and direction, using an aggregate relation.
     *
     * @param EloquentBuilder $query The Eloquent query builder instance.
     */
    private function orderColumnBy(EloquentBuilder $query): void
    {
        $tableName = $this->getRelationalName($this->clickColumn);
        $query->withAggregate($tableName, $this->clickColumn)
            ->orderBy($tableName.'_'.$this->clickColumn, $this->orderDirection)
            ->with($this->model::getRelationModel());
    }

    /**
     * Determines the relational name and associated attributes based on the provided key.
     *
     * @param  string|null $string The key to map to relational attributes.
     * @return string|null The relational name or null if no match is found.
     */
    private function getRelationalName(?string $string): ?string
    {
        $relationMap = [];
        foreach ($this->searchableFields as $relation => $fields) {
            $relationMap[$relation] = $fields;
        }

        return searchKeyArray($relationMap, $string);
    }

    /**
     * Determines the table name based on the provided column name.
     *
     * @param  int|string $string The column name to map to a table.
     * @return string|null The table name or null if no match is found.
     */
    private function tableName(int|string $string): ?string
    {
        $tableMap = [];
        foreach ($this->searchableFields as $relation => $fields) {
            $tableName = $this->getTableNameFromRelation($relation);
            $tableMap[$tableName] = $fields;
        }

        return searchKeyArray($tableMap, $string);
    }

    /**
     * Converts relation name to table name.
     *
     * @param  string $relation The relation name.
     * @return string The corresponding table name.
     */
    private function getTableNameFromRelation(string $relation): string
    {
        return match ($relation) {
            'person' => 'people',
            'specialty' => 'specialties',
            'blood_type' => 'blood_types',
            default => $relation
        };
    }

    /**
     * Determines the index name based on the provided table name.
     *
     * @param  string|null $string The table name to map to an index.
     * @return string|null The index name or null if no match is found.
     */
    private function indexName(?string $string): ?string
    {
        $indexMap = [];
        foreach ($this->searchableFields as $relation => $fields) {
            $tableName = $this->getTableNameFromRelation($relation);
            $indexName = $relation === 'person' ? 'person_id' : $relation.'_id';
            $indexMap[$indexName] = $tableName;
        }

        return searchKeyArray($indexMap, $string);
    }

    /**
     * Creates a query for pivot table relations.
     *
     * @param EloquentBuilder $query        The main query builder instance.
     * @param string          $relation     The pivot relation name.
     * @param mixed           $stringsearch The search term.
     */
    private function createQueryPivot(EloquentBuilder $query, string $relation, mixed $stringsearch): EloquentBuilder
    {
        $stringsearch = mb_strtolower((string) $stringsearch);

        // Handle nested relations like 'person.gender'
        if (str_contains($relation, '.')) {
            $relations = explode('.', $relation);
            $finalRelation = array_pop($relations);
            $nestedRelation = implode('.', $relations);

            return $query->whereHas(
                $nestedRelation,
                function ($query) use ($stringsearch, $finalRelation) {
                    $query->whereHas(
                        $finalRelation,
                        function ($subQuery) use ($stringsearch, $finalRelation) {
                            $searchField = $this->getPivotSearchField($finalRelation);
                            $subQuery->where(DB::raw('LOWER('.$searchField.')'), 'like', "%{$stringsearch}%");
                        }
                    );
                }
            );
        }

        return $query->whereHas(
            $relation,
            function ($query) use ($stringsearch, $relation) {
                $searchField = $this->getPivotSearchField($relation);
                $query->where(DB::raw('LOWER('.$searchField.')'), 'like', "%{$stringsearch}%");
            }
        );
    }

    /**
     * Gets the search field for pivot relations.
     *
     * @param  string $relation The pivot relation name.
     * @return string The field to search in the pivot relation.
     */
    private function getPivotSearchField(string $relation): string
    {
        return match ($relation) {
            'credentials' => 'credential_number',
            'gender' => 'gender_name',
            default => 'name'
        };
    }

    /**
     * Builds and returns an Eloquent query with a subquery filter.
     *
     * @param EloquentBuilder $query        The main query builder instance.
     * @param string|null     $tableName    The table name to search in.
     * @param string|null     $indexName    The index column name.
     * @param int|string      $column       The column to search.
     * @param mixed           $stringsearch The search term.
     */
    private function createQuery(
        EloquentBuilder $query,
        ?string $tableName,
        ?string $indexName,
        int|string $column,
        mixed $stringsearch
    ): EloquentBuilder {
        $stringsearch = mb_strtolower((string) $stringsearch);

        return $query->whereIn(
            $indexName,
            function (QueryBuilder $subquery) use ($stringsearch, $column, $tableName): QueryBuilder {
                return $subquery->select('id')
                    ->from($tableName)
                    ->where(DB::raw('LOWER('.$column.')'), 'like', "%{$stringsearch}%");
            }
        );
    }
}
