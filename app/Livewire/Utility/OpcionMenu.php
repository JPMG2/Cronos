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

    public function mount($namecomponent)
    {
        $this->namecomponent = $namecomponent;
    }

    public function render()
    {
        return view('livewire.utility.opcion-menu');
    }

    #[On('showOptionsForms')]
    public function optionsOn($show)
    {
        if ($show === false) {
            $this->resetColor();
        }
        $this->showbutton = $show;
    }

    #[On('clearColorOpcionMenu')]
    public function resetColor()
    {
        $this->optioncolor = ['show' => false, 'new' => false, 'edit' => false, 'print' => false, 'export' => false, 'history' => false];
    }

    public function changeColor($option)
    {

        $this->optioncolor = Arr::map(
            $this->optioncolor, function (string $value, string $key) use ($option) {
                if ($key === $option) {
                    $value = true;
                } else {
                    $value = false;
                }

                return $value;
            }
        );

    }
}
