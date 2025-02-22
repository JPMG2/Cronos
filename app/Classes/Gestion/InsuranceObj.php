<?php

namespace App\Classes\Gestion;

use App\Models\Insurance;
use App\Traits\UtilityForm;

class InsuranceObj
{
    use UtilityForm;

    protected $modelName = 'Insurance';

    /**
     * Store a new insurance record.
     *
     * This method creates a new insurance record with the provided data.
     * It uses the `getValuesModel` method to extract the necessary values
     * from the input array and then creates the insurance record.
     *
     * @param  array  $arrayInsurance  The data for creating the insurance record.
     * @return Insurance The newly created insurance record.
     */
    public function store(array $arrayInsurance): Insurance
    {
        return Insurance::create($this->getValuesModel($arrayInsurance, $this->modelName));
    }

    /**
     * Update the specified insurance record.
     *
     * This method updates an existing insurance record with the provided data.
     * It retrieves the insurance record by its ID, updates it with the new values,
     * and returns the updated insurance instance.
     *
     * @param  array  $arrayInsurance  The data for updating the insurance record.
     * @param  int  $insuranceId  The ID of the insurance record to update.
     * @return Insurance The updated insurance record.
     */
    public function update(array $arrayInsurance, int $insuranceId): Insurance
    {

        $insurance = Insurance::findOrFail($insuranceId);
        $insurance->update($this->getValuesModel($arrayInsurance, $this->modelName));

        return $insurance;
    }

    /**
     * Display the specified insurance record.
     *
     * This method retrieves an insurance record by its ID, including its related
     * insurance type, state, and city with province information.
     *
     * @param  int  $idInsurance  The ID of the insurance record to retrieve.
     * @return Insurance The insurance record with its related data.
     */
    public function show(int $idInsurance): Insurance
    {
        return Insurance::with(['insuranceType', 'state', 'city.province'])->findOrFail($idInsurance);
    }
}
