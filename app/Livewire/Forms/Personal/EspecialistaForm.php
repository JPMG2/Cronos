<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Personal;

use App\Classes\Personal\EspecialistObj;
use App\Classes\Personal\EspecialistValidation;
use App\Classes\Utilities\NotifyQuerys;
use Livewire\Form;

final class EspecialistaForm extends Form
{
    public $dataespecialist = [
        'state_id' => 1,
        'credential_id' => '',
        'specialty_id' => null,
        'degree_id' => null,
        'medical_name' => '',
        'medical_lastname' => '',
        'medical_address' => '',
        'medical_phone' => '',
        'medical_email' => '',
        'medical_dni' => '',
        'medical_codenumber' => '',
    ];

    /**
     * Stores a new specialist record.
     *
     * This method validates the specialist data and stores it in the database.
     * It then sends a notification message indicating the creation of the record.
     *
     * @param  EspecialistValidation  $validation  The validation instance for specialist data.
     * @param  EspecialistObj  $especialistobj  The specialist object instance.
     * @return mixed The result of the notification message creation.
     */
    public function especialistStore(EspecialistValidation $validation, EspecialistObj $especialistobj)
    {
        return NotifyQuerys::msgCreate($especialistobj->store($validation->onEspecialistCreate($this->dataespecialist)));
    }

    /**
     * Updates an existing specialist record.
     *
     * This method validates the updated specialist data and updates the record in the database.
     * It then sends a notification message indicating the update of the record.
     *
     * @param  EspecialistValidation  $validation  The validation instance for specialist data.
     * @param  EspecialistObj  $especialistobj  The specialist object instance.
     * @return mixed The result of the notification message update.
     */
    public function especialistUpdate(EspecialistValidation $validation, EspecialistObj $especialistobj)
    {
        return NotifyQuerys::msgUpadte($especialistobj->update($validation->onEspecialistUpdate($this->dataespecialist), $this->dataespecialist['id']));
    }

    /**
     * Retrieves and sets the medical information for a specialist.
     *
     * This method fetches the medical information for a given specialist ID,
     * updates the `dataespecialist` property with the retrieved data, and sets
     * the specialty and degree names if available.
     *
     * @param  EspecialistObj  $especialistObj  The specialist object instance.
     * @param  int  $medicalId  The ID of the medical specialist to retrieve information for.
     * @return void
     */
    public function infoMedic(EspecialistObj $especialistObj, int $medicalId)
    {
        $dataMedic = $especialistObj->show($medicalId);

        if ($dataMedic) {
            $this->dataespecialist['specialty_id'] = optional($dataMedic->specialty)->specialty_name ?? null;
            $this->dataespecialist['degree_id'] = optional($dataMedic->degree)->degree_name ?? null;
            $this->dataespecialist = $dataMedic->toArray();
            $this->dataespecialist['medical_codenumber'] = $dataMedic->first_credential_number;

        }
    }
}
