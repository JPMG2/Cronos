<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Servicios;

use App\Classes\MainPerson\PersonValidation;
use Livewire\Form;

final class PacienteForm extends Form
{
    public $pacienteData = [
        'document_id' => '1',
        'city_id' => null,
        'gender_id' => 1,
        'occupation_id' => null,
        'marital_status_id' => null,
        'nationality_id' => null,
        'num_document' => '',
        'person_name' => '',
        'person_lastname' => '',
        'person_datebirth' => '',
        'person_phone' => '',
        'person_email' => '',
        'person_address' => '',
        'patient_photo' => '',
    ];

    public function pacienteStore(PersonValidation $personValidation): array
    {
        $personValidation->onPersonCreate($this->pacienteData);
        dd('hola');
    }
}
