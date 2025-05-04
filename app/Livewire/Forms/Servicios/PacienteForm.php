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
    public array $pesonData = [
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

    public array $pacienteData = [
        'patient_photo' => '',
    ];

    public function pacienteStore(
        PatientPersonValidation $patientValidation,
        PersonValidation $personValidation): array
    {
        $patientValidation->onPatientPersonCreate($this->pesonData);
        $personValidation->onPersonCreate($this->pesonData);

        return $this->handleService('msgCreate',
            fn ($services) => $services->createAndAssociate(
                $this->pesonData, $this->pacienteData, 'patiente')
        );

    }

    public function pacienteUpdate(
        PatientPersonValidation $patientValidation,
        PersonValidation $personValidation): array
    {
        $patientValidation->onPatientPersonUpdate($this->pesonData, (int) $this->pesonData['id']);

        $personValidation->onPersonUpdate($this->pesonData, (int) $this->pesonData['id']);

        return $this->handleService('msgUpadte',
            fn ($services) => $services->updateAndAssociate(
                (int) $this->pesonData['id'], $this->pesonData, $this->pacienteData, 'patiente')
        );
    }

    public function validateDocumente(PatientPersonValidation $patientValidation, $typeQuery): void
    {

        if (! $typeQuery) {
            $patientValidation->onPatientPersonCreate($this->pesonData);
        } else {
            $patientValidation->onPatientPersonUpdate($this->pesonData, (int) $this->pesonData['id']);
        }

    }

    public function infoPatient($patientId): void
    {
        $services = $this->iniService();
        $info = $services->showWithRelationship($patientId, 'showDataPatient');
        $this->pesonData = $info->toArray();

    }

    private function handleService(string $msgType, callable $callback): array
    {
        $services = $this->iniService();

        return NotifyQuerys::{$msgType}($callback($services));
    }

    private function iniService()
    {
        return app()->make(ModelService::class, ['model' => new Person]);
    }
}
