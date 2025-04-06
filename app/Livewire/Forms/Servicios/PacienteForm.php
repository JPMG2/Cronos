<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Servicios;

use App\Classes\MainPerson\PatientPersonValidation;
use App\Classes\MainPerson\PersonValidation;
use App\Classes\Services\ModelService;
use App\Classes\Utilities\NotifyQuerys;
use App\Models\Person;
use Livewire\Form;

final class PacienteForm extends Form
{
    public $pesonData = [
        'document_id' => 1,
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

    ];

    public $pacienteData = [
        'patient_photo' => '',
    ];

    public function pacienteStore(
        PatientPersonValidation $patientValidation,
        PersonValidation $personValidation): array
    {
        $patientValidation->onPatientPersonCreate($this->pesonData);
        $personValidation->onPersonCreate($this->pesonData);

        $services = $this->iniService();

        return NotifyQuerys::msgCreate($services->storeRelastionship(
            $this->pesonData, $this->pacienteData, 'patiente')
        );
    }

    public function validateDocumente(PatientPersonValidation $patientValidation, $typeQuery)
    {
        if (! $typeQuery) {
            $patientValidation->onPatientPersonCreate($this->pesonData);
        }
    }

    protected function iniService()
    {
        return app()->make(ModelService::class, ['model' => new Person]);
    }
}
