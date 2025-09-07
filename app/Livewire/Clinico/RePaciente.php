<?php

declare(strict_types=1);

namespace App\Livewire\Clinico;

use App\Classes\Person\MainPerson;
use App\Classes\Utilities\AlertModal;
use App\Classes\Utilities\CommonQuerys;
use App\Dto\PatientDto;
use App\Livewire\Forms\Clinico\PacienteForm;
use App\Models\Patient;
use App\Traits\FormHandling;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

final class RePaciente extends Component
{
    use FormHandling;

    public PacienteForm $pacienteForm;

    #[Title(' - Pacientes')]
    public function render()
    {
        return view('livewire.clinicos.re-paciente');
    }

    public function mount(): void
    {
        $this->pacienteForm->personData ??= new PatientDto();
    }

    #[Computed]
    public function documentType()
    {
        return CommonQuerys::listDocuments();
    }

    #[Computed]
    public function maritalStatus()
    {
        return CommonQuerys::listMaritalStatus();
    }

    #[Computed]
    public function gender()
    {
        return CommonQuerys::listGenders();
    }

    #[Computed]
    public function numpatients()
    {
        return Patient::query()->count();
    }

    #[Computed]
    public function occupation()
    {
        return CommonQuerys::listOcupacion();
    }

    #[Computed]
    public function nationality()
    {
        return CommonQuerys::listNacionalidad();
    }

    public function submitPatient(): void
    {
        $result = $this->isupdate ?
            $this->pacienteForm->pacienteUpdate() :
            $this->pacienteForm->patientStore();
        $messageType = $this->isupdate ? 'msgUpadte' : 'msgCreate';
        $message = $this->showQueryMessage($result, $messageType);
        $this->showToastAndClear($message);
        $this->clearForm();
    }

    public function clearForm(): void
    {
        $this->pacienteForm->reset();
        $this->isupdate = false;
        $this->pacienteForm->setUp();
        $this->dispatch('showOptionsForms', show: false);
        $this->cleanFormValues();
        $this->resetAllProvince();
    }

    public function validatePersonExits(MainPerson $mainPerson): void
    {
        $result = $mainPerson->findAsPatient($this->pacienteForm->personData->num_document);

        if (! $this->isupdate && $result) {
            $this->categorizePersonData($result);
            $this->isupdate = true;
        }
    }

    public function infoPerson(): void
    {
        $this->dispatch('clear-errors');
        $this->dispatch('close-modal-data');
        $array = $this->infoPersonArray($this->pacienteForm->personData->toArray());
        $this->pacienteForm->personData = PatientDto::fromArray($array);
    }

    public function patientHandleMenuAction(string $nameoption): void
    {
        $this->dispatch('clear-errors');
        $id = $this->pacienteForm->personData->person_id ?? 0;
        $this->handleAction($nameoption, [
            'id' => $id,
            'pdfClass' => 'PatientPdf',
            'route' => 're_paciente',
            'model' => 'Patient',
        ]);
    }

    #[On('dataPatient')]
    public function patienteLoadData($patientId): void
    {
        $this->dispatch('showOptionsForms', show: true);
        $this->pacienteForm->reset();
        $this->isupdate = true;
        $this->pacienteForm->infoPatient($patientId);
        $this->loadProvinceData();
    }

    public function selectProvince(int $provinceId): void
    {
        $this->setProvinceCity($provinceId, 0);
        $this->pacienteForm->personData->province_id = $provinceId;
        $this->showProvince = false;
    }

    private function loadProvinceData(): void
    {
        if ($this->pacienteForm->personData->province_id) {
            $this->setProvinceCity($this->pacienteForm->personData->province_id, 0);
            $this->setnameProvinceCity(
                $this->dataProvince($this->pacienteForm->personData->province_id)->province_name->toString(), null);

        }
    }

    private function patientPerson(int $patientId): void
    {
        $this->pacienteForm->infoPatient($patientId);
        $this->showMenuAction();
        $person = $this->pacienteForm->personData->person_name.' '.$this->pacienteForm->personData->person_lastname;
        $this->messageWindow($person, fn (string $person): AlertModal => new AlertModal(
            exception: 0,
            type: 'advice',
            title: 'Aviso',
            buttonName: 'Aceptar',
            event: '',
            message: 'Paciente <b>'.$person.'</b> ya registrado !',
            idModel: 0
        ));

    }
}
