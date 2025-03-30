<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Servicios;

use Livewire\Form;

final class PacienteForm extends Form
{
    public $pacienteData = [
        'document_id' => 1,
        'city_id' => null,
        'gender_id' => 1,
        'occupation_id' => null,
        'marital_status_id' => null,
        'nationality_id' => null,
        'num_document' => '',
        'patient_name' => '',
        'patient_lastname' => '',
        'patient_datebirth' => '',
        'patient_phone' => '',
        'patient_email' => '',
        'patient_address' => '',
        'patient_photo' => '',
    ];
}
