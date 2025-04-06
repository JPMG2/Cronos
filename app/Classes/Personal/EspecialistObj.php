<?php

declare(strict_types=1);

/**
 * Class EspecialistObj
 *
 * Handles operations related to Medical specialists including storing,
 * updating, and retrieving medical specialist records and their associated credentials.
 */

namespace App\Classes\Personal;

use App\Models\Credential;
use App\Models\Medical;
use App\Traits\UtilityForm;

final class EspecialistObj
{
    use UtilityForm;

    protected $modelName = 'Medical';

    /**
     * Stores a new medical specialist record.
     *
     * This method creates a new medical specialist record in the database using the provided data.
     * It also associates the specialist with their credentials if available.
     *
     * @param  array  $arrayEspecialist  The data for the medical specialist.
     * @return Medical The created medical specialist record.
     */
    public function store(array $arrayEspecialist): Medical
    {

        $medical = Medical::create($this->getValuesModel($arrayEspecialist, $this->modelName));

        $credentials = Credential::find($arrayEspecialist['credential_id']);

        if ($credentials) {
            $medical->credentials()->attach($credentials->id, ['credential_number' => $arrayEspecialist['medical_codenumber']]);
        }

        return $medical;
    }

    /**
     * Updates an existing medical specialist record.
     *
     * This method finds the medical specialist by ID, updates the record with the provided data,
     * and updates the associated credentials with the new credential number.
     *
     * @param  array  $arrayEspeciaist  The data for the medical specialist.
     * @param  int  $spcialistId  The ID of the medical specialist to update.
     * @return Medical The updated medical specialist record.
     */
    public function update(array $arrayEspeciaist, int $spcialistId): Medical
    {
        $medical = Medical::findOrFail($spcialistId);

        $medical->update($this->getValuesModel($arrayEspeciaist, $this->modelName));

        $medical->credentials()->updateExistingPivot($arrayEspeciaist['credential_id'], ['credential_number' => $arrayEspeciaist['medical_codenumber']]);

        return $medical;
    }

    /**
     * Retrieves a medical specialist record by ID.
     *
     * This method fetches the medical specialist record from the database
     * using the provided medical ID.
     *
     * @param  int  $medicalId  The ID of the medical specialist to retrieve.
     * @return Medical|null The medical specialist record, or null if not found.
     */
    public function show(int $medicalId)
    {
        return Medical::listMedicals()->findOrFail($medicalId);
    }
}
