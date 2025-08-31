<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Clinicos;

use App\Action\Patient\CreatePatiente;
use App\Action\Patient\UpdatePatiente;
use App\Action\PersonAct\UpdatePerson;
use App\Classes\Patient\MainPatient;
use App\Classes\Patient\PacienteValidation;
use App\Dto\PatientDto;
use App\Models\Patient;
use App\Models\Person;
use Livewire\Form;

/**
 * Form state and services for patient creation and updates.
 *
 * @property PatientDto|null $personData DTO holding person/patient fields
 * @property array{patient_photo:string} $pacienteData Additional patient data shape
 * @property-read MainPatient|null $patient Lazy-resolved service for patient operations
 * @property-read PacienteValidation|null $validation Lazy-resolved validator for patient
 * @property-read CreatePatiente|null $createPatient Lazy-resolved action to create patient
 */
final class PacienteForm extends Form
{
    public ?PatientDto $personData = null;

    public array $pacienteData = [
        'patient_photo' => '',
    ];

    private ?MainPatient $patient = null;

    private ?PacienteValidation $validation = null;

    private ?CreatePatiente $createPatient = null;

    private ?UpdatePerson $updatePerson = null;

    private ?UpdatePatiente $updatePatient = null;

    public function setUp(): void
    {
        $this->personData ??= new PatientDto();
    }

    public function patientStore(): Patient
    {
        $this->validation()->onCreate($this->mergeFormData());

        $patient = $this->createPatientAction()->handle($this->mergeFormData());

        $this->patient()->handleNotification($patient);

        return $patient;
    }

    public function pacienteUpdate(): Person|Patient
    {

        $this->validation()->onUpdate($this->mergeFormData(), (int) $this->personData->person_id);

        $person = $this->updatePersonAction()->handle($this->mergeFormData(), (int) $this->personData->person_id);

        $patient = $this->updatePatientAction()->handle($this->mergeFormData(), $person);

        $emailChange = $person?->wasChanged('person_email');

        $this->patient()->handleNotification($patient, $emailChange);

        return $person->wasChanged() ? $person : $patient;
    }

    public function infoPatient(int $patientId): void
    {
        $info = $this->patient()->show($patientId);
        $dto = PatientDto::fromArray($info->person->toArray());
        $dto->person_id = $info->person->id;
        $this->personData = $dto;

    }

    private function validation(): PacienteValidation
    {
        return $this->validation ??= resolve(PacienteValidation::class);
    }

    private function mergeFormData(): array
    {
        return arrayMerge($this->personData->toArray(), $this->pacienteData);
    }

    private function createPatientAction(): CreatePatiente
    {
        return $this->createPatient ??= resolve(CreatePatiente::class);
    }

    private function patient(): MainPatient
    {
        return $this->patient ??= resolve(MainPatient::class);
    }

    private function updatePersonAction(): UpdatePerson
    {
        return $this->updatePerson ??= resolve(UpdatePerson::class);
    }

    private function updatePatientAction(): UpdatePatiente
    {
        return $this->updatePatient ??= resolve(UpdatePatiente::class);
    }
}
