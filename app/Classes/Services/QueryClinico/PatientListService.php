<?php

declare(strict_types=1);

namespace App\Classes\Services\QueryClinico;

use App\Classes\Services\QueryPerson\PersonSearchService;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

/**
 * Final readonly class PatientListService
 *
 * This class provides methods for querying patient records with filters,
 * relationships, and ordering. It uses the generic PersonSearchService
 * with patient-specific configuration.
 */
final readonly class PatientListService
{
    private PersonSearchService $searchService;

    /**
     * Constructs a new instance and initializes the generic search service
     * with patient-specific configuration.
     *
     * @param  Patient  $model  The patient model instance to be used.
     * @param  bool  $order  Determines the order direction.
     * @param  string|null  $clickColumn  Specifies the column to be clicked, if any.
     */
    public function __construct(Patient $model, bool $order, ?string $clickColumn)
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
     * Retrieves a filtered and ordered list of patient records based on the provided conditions.
     *
     * @param  array  $filterConditions  An array of column filtering conditions.
     * @return EloquentBuilder A query builder instance with applied filters, sorting, and relationships.
     */
    public function listSearch(array $filterConditions): EloquentBuilder
    {
        return $this->searchService->listSearch($filterConditions);
    }

    /**
     * Defines the searchable fields configuration for patients.
     *
     * @return array The patient-specific searchable fields.
     */
    private function getSearchableFields(): array
    {
        return [
            'person' => 'person_name,person_lastname,num_document,person_email,person_phone',
            'blood_type' => 'blood_type_name',
        ];
    }

    /**
     * Defines the pivot relations for patients.
     *
     * @return array The patient-specific pivot relations (empty for patients).
     */
    private function getPivotRelations(): array
    {
        return [
            'gender_name' => 'person.gender',
        ];
    }
}
