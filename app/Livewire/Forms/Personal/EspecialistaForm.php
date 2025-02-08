<?php

namespace App\Livewire\Forms\Personal;

use App\Classes\Personal\EspecialistObj;
use App\Classes\Personal\EspecialistValidation;
use App\Classes\Utilities\NotifyQuerys;
use Livewire\Form;

class EspecialistaForm extends Form
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

    public function especialistStore(EspecialistValidation $validation, EspecialistObj $especialistobj)
    {

        return NotifyQuerys::msgCreate($especialistobj->store($validation->onEspecialistCreate($this->dataespecialist)));
    }
}
