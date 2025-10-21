<?php

declare(strict_types=1);

namespace App\Livewire\Convenio;

use App\Livewire\Forms\Convenio\ObraSocialTypeForm;
use App\Models\InsuranceType;
use App\Traits\UtilityForm;
use Livewire\Attributes\On;
use Livewire\Component;

final class ObraSocialTipo extends Component
{
    use UtilityForm;

    public $show = false;

    public ObraSocialTypeForm $formtype;

    #[\Livewire\Attributes\Computed]
    public function types()
    {
        return InsuranceType::listType()->get();
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.convenio.obra-social-tipo');
    }

    public function queryInsuraceType(): void
    {

        if (! $this->isupdate) {
            $result = app()->call($this->formtype->insuratypeStore(...));
        } else {
            $result = app()->call($this->formtype->insuratypeUpdate(...));
        }

        $this->endInsuraceType($result);
    }

    public function endInsuraceType($result): void
    {
        $this->dispatch('show-toast', $result);
        $this->dispatch('reloadInsuraceType');
        $this->clearFormChild();
        $this->toggleModal();
        $this->isupdate = false;
    }

    public function clearFormChild(): void
    {
        $this->formtype->reset();
        $this->resetErrorBag();
        $this->isupdate = false;
    }

    #[On('showTypesModal')]
    public function toggleModal(): void
    {
        $this->show = ! $this->show;
    }

    public function insuranceInfo($idInsuraType): void
    {
        $this->isupdate = true;
        app()->call($this->formtype->insuranceData(...), ['idInsuraType' => $idInsuraType]);
    }
}
