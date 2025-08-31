<?php

declare(strict_types=1);

namespace App\Classes\Services\QueryPerson;

use App\Models\Medical;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

/**
 * Final readonly class MedicListService
 *
 * This class provides methods for querying medical records with filters,
 * relationships, and ordering. It uses the generic PersonSearchService
 * with medical-specific configuration.
 */
final readonly class MedicListService
{
    private PersonSearchService $searchService;

    /**
     * Constructs a new instance and initializes the generic search service
     * with medical-specific configuration.
     *
     * @param  Medical  $model  The medical model instance to be used.
     * @param  bool  $order  Determines the order direction.
     * @param  string|null  $clickColumn  Specifies the column to be clicked, if any.
     */
    public function __construct(Medical $model, bool $order, ?string $clickColumn)
    {
        $this->searchService = new PersonSearchService(
            model: $model,
            order: $order,
            clickColumn: $clickColumn,
            searchableFields: $this->getSearchableFields(),
            pivotRelations: $this->getPivotRelations()
        );
    }

    /**
     * Retrieves a filtered and ordered list of medical records based on the provided conditions.
     *
     * @param  array  $filterConditions  An array of column filtering conditions.
     * @return EloquentBuilder A query builder instance with applied filters, sorting, and relationships.
     */
    public function listSearch(array $filterConditions): EloquentBuilder
    {
        return $this->searchService->listSearch($filterConditions);
    }

    /**
     * Defines the searchable fields configuration for medical records.
     *
     * @return array The medical-specific searchable fields.
     */
    private function getSearchableFields(): array
    {
        return [
            'person' => 'person_name,person_lastname,num_document',
            'specialty' => 'specialty_name',
            'state' => 'state_name',
            'credentials' => 'credential_number',
        ];
    }

    /**
     * Defines the pivot relations for medical records.
     *
     * @return array The medical-specific pivot relations.
     */
    private function getPivotRelations(): array
    {
        return ['credential_number' => 'credentials'];
    }
}
