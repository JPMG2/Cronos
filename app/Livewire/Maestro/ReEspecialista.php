<?php

declare(strict_types=1);

namespace App\Livewire\Maestro;

use App\Classes\Person\MainPerson;
use App\Classes\Utilities\AlertModal;
use App\Classes\Utilities\CommonQueries;
use App\Dto\SpecialistDto;
use App\Livewire\Forms\Maestro\EspecialistaForm;
use App\Models\Medical;
use App\Traits\FormHandling;
use App\Traits\HandlesActionPolicy;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

final class ReEspecialista extends Component
{
    use FormHandling;
    use HandlesActionPolicy;

    public EspecialistaForm $formHandler;

    public function mount(): void
    {
        $this->formHandler->personData ??= new SpecialistDto();
    }

    #[Title(' - Especialista')]
    public function render()
    {
        return view('livewire.maestro.re-especialista');
    }

    #[Computed]
    public function listDocument(): Collection
    {
        return CommonQueries::listDocuments();
    }

    #[Computed]
    public function listState(): Collection
    {
        return CommonQueries::stateQuery([1, 2]);
    }

    #[Computed]
    public function listSpecialties(): Collection
    {
        return CommonQueries::listSpecialties();
    }

    #[Computed]
    public function listDegree(): Collection
    {
        return CommonQueries::listDegrees();
    }

    #[Computed]
    public function listCredential(): Collection
    {
        return CommonQueries::listCredentials();
    }

    /**
     * @throws Exception
     */
    public function submitSpecialist(): void
    {
        $result = $this->isupdate ? $this->formHandler->specialistUpdate() : $this->formHandler->specialistStore();
        $messageType = $this->isupdate ? 'msgUpdateCreate' : 'msgCreate';
        $message = $this->showQueryMessage($result, $messageType);
        $this->showToastAndClear($message);
        $this->clearForm();
    }

    public function clearForm(): void
    {
        $this->isupdate = false;
        $this->formHandler->reset();
        $this->cleanFormValues();
        $this->formHandler->setUp();
        $this->dispatch('showOptionsForms', show: false);
    }

    #[Computed]
    public function medicals(): int
    {
        return (int) Medical::query()->count();
    }

    #[On('dataMedical')]
    public function medicalLoadData(int $medicalId): void
    {
        $this->formHandler->infoMedic($medicalId);
        $this->showMenuAction();
        $this->isupdate = true;
    }

    public function especialistHandleMenuAction(string $nameoption): void
    {

        $this->dispatch('clear-errors');
        $id = $this->formHandler->dataespecialist['id'] ?? 0;
        $this->handleAction(
            $nameoption,
            [
                'id' => $id,
                'pdfClass' => 'MedicPdf',
                'route' => 're_especialist',
                'model' => 'Medical',
            ],
        );
    }

    public function validatePersonExits(MainPerson $mainPerson): void
    {
        $result = $mainPerson->findAsMedic($this->formHandler->personData->num_document);

        if (! $this->isupdate && $result) {
            $this->categorizePersonData($result);
            $this->isupdate = true;
        }
    }

    public function infoPerson(): void
    {
        $this->dispatch('clear-errors');
        $this->dispatch('close-modal-data');
        $array = $this->infoPersonArray($this->formHandler->personData->toArray());
        $this->formHandler->personData = SpecialistDto::fromArray($array);

    }

    private function medicalPerson(int $medicId): void
    {
        $this->formHandler->infoMedic($medicId);
        $this->showMenuAction();
        $person = $this->formHandler->personData->person_name . ' ' . $this->formHandler->personData->person_lastname;
        $this->messageWindow(
            $person,
            fn (string $person): AlertModal => new AlertModal(
                exception: 0,
                type: 'advice',
                title: 'Aviso',
                buttonName: 'Aceptar',
                event: '',
                message: 'Especialista <b>' . $person . '</b> ya registrada !',
                idModel: 0,
            ),
        );

    }
}
