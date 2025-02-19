<?php

namespace App\Classes\Gestion;

use App\Models\InsuranceType;
use App\Traits\UtilityForm;

class InsuranceTypeObj
{
    use UtilityForm;

    protected $modelName = 'InsuranceType';

    /**
     * Stores a new insurance type record.
     *
     * This method creates a new insurance type record in the database using the provided data.
     *
     * @param  array  $arrayInsuranceType  The data for the insurance type.
     * @return InsuranceType The created insurance type record.
     */
    public function store(array $arrayInsuranceType): InsuranceType
    {
        return InsuranceType::create($this->getValuesModel($arrayInsuranceType, $this->modelName));
    }

    /**
     * Updates an existing insurance type record.
     *
     * This method finds the insurance type by ID, updates the record with the provided data,
     * and returns the updated insurance type instance.
     *
     * @param  array  $arrayInsuranceType  The data for the insurance type.
     * @return InsuranceType The updated insurance type record.
     */
    public function update(array $arrayInsuranceType): InsuranceType
    {

        $insurace = InsuranceType::find($arrayInsuranceType['id']);

        $insurace->update($this->getValuesModel($arrayInsuranceType, $this->modelName));

        return $insurace;
    }

    /**
     * Retrieves an insurance type record by ID.
     *
     * This method fetches the insurance type record from the database
     * using the provided ID.
     *
     * @param  int  $id  The ID of the insurance type to retrieve.
     * @return InsuranceType|null The insurance type record, or null if not found.
     */
    public function show(int $id)
    {
        return InsuranceType::findOrFail($id);
    }
}
