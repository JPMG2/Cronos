<?php

namespace App\Livewire\Personal;

use App\Livewire\Forms\Personal\EspecialistaForm;
use App\Models\Medical;
use App\Traits\HandlesActionPolicy;
use App\Traits\UtilityForm;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class ReEspecialista extends Component
{
    use HandlesActionPolicy,UtilityForm;

    public EspecialistaForm $formesp;

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

            $result = app()->call([$this->formesp, 'especialistUpdate']);
        }
        $this->endEspeciales($result);
    }

    public function endEspeciales($result)
    {
        $this->dispatch('show-toast', $result);
        $this->clearForm();
    }

    public function getMedicalsProperty()
    {
        return Medical::countMedicals();
    }

    public function clearForm()
    {
        $this->isupdate = false;
        $this->formesp->reset();
        $this->cleanFormValues();
        $this->dispatch('showOptionsForms', show: false);
    }

    public function especialistShow()
    {
        $this->dispatch('showOptionForm', 'showModalEspecialist', true);
    }

    public function especialistEdit()
    {
        $this->editActivate();

    }

    public function especialistPrint(): void
    {
        $idEspecialist = $this->formesp->dataespecialist['id'];

        $className = 'MedicPdf';

        $this->dispatch('printByID', ['idmodel' => $idEspecialist, 'className' => $className]);

    }

    #[On('dataMedical')]
    public function medicalLoadData($medicalId)
    {
        app()->call([$this->formesp, 'infoMedic'], ['medicalId' => $medicalId]);
        $this->dispatch('showOptionsForms', show: true);
        $this->isdisabled = 'disabled';
    }
}
