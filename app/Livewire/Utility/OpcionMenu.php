<?php

declare(strict_types=1);

namespace App\Livewire\Utility;

use App\Traits\HandlesActionPolicy;
use Illuminate\Support\Arr;
use Livewire\Attributes\On;
use Livewire\Component;

final class OpcionMenu extends Component
{
    use HandlesActionPolicy;

    public $namecomponent;

    public $showbutton = false;

    public $optioncolor = ['show' => false, 'new' => false, 'edit' => false, 'print' => false, 'export' => false, 'history' => false];

    public function mount($namecomponent): void
    {
        $this->namecomponent = $namecomponent;
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.utility.opcion-menu');
    }

    #[On('showOptionsForms')]
    public function optionsOn($show): void
    {
        if ($show === false) {
            $this->resetColor();
        }
        $this->showbutton = $show;
    }

    #[On('clearColorOpcionMenu')]
    public function resetColor(): void
    {
        $this->optioncolor = ['show' => false, 'new' => false, 'edit' => false, 'print' => false, 'export' => false, 'history' => false];
    }

    public function changeColor($option): void
    {

        $this->optioncolor = Arr::map(
            $this->optioncolor,
            fn (string $value, string $key): bool => $key === $option
        );

    }
}
