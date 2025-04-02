<?php

declare(strict_types=1);

namespace App\Livewire\Personal;

use App\Livewire\Forms\Personal\EspecialistaForm;
use App\Models\Medical;
use App\Traits\FormActionsTrait;
use App\Traits\HandlesActionPolicy;
use App\Traits\UtilityForm;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

final class ReEspecialista extends Component
{
    use FormActionsTrait,HandlesActionPolicy, UtilityForm;

    public EspecialistaForm $formesp;

    protected $commonQuerys;

    #[Title(' - Especialista')]
    public function render()
    {
        $this->commonQuerys = app('commonquery');

        return view('livewire.personal.re-especialista', [
            'listState' => $this->commonQuerys::stateQuery([1, 2]),
            'listSpecialties' => $this->commonQuerys::listSpecialties(),
            'listDegree' => $this->commonQuerys::listDegrees(),
            'listCredential' => $this->commonQuerys::listCredentials(),
        ]);
    }

    public function getEspecialis()
    {
        if (! $this->isupdate) {
            $result = app()->call([$this->formesp, 'especialistStore']);
        } else {
            dd('update');
            $result = app()->call([$this->formesp, 'especialistUpdate']);
        }
        $this->endEspeciales($result);
    }

    public function endEspeciales($result)
    {
        $this->dispatch('show-toast', $result);
        $this->clearForm();
    }

    public function clearForm()
    {
        $this->isupdate = false;
        $this->formesp->reset();
        $this->cleanFormValues();
        $this->dispatch('showOptionsForms', show: false);
    }

    public function getMedicalsProperty()
    {
        return Medical::countMedicals();
    }

    #[On('dataMedical')]
    public function medicalLoadData($medicalId)
    {
        $this->formesp->reset();
        app()->call([$this->formesp, 'infoMedic'], ['medicalId' => $medicalId]);
        $this->dispatch('showOptionsForms', show: true);
        $this->isdisabled = 'disabled';
    }

    public function especialistHandleMenuAction(string $nameoption)
    {
        $id = $this->formesp->dataespecialist['id'] ?? 0;
        $this->handleAction($nameoption, [
            'id' => $id,
            'pdfClass' => 'MedicPdf',
            'route' => 're_especialist',
            'model' => 'Medical',
        ]);
    }
}
