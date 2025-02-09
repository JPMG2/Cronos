<?php

namespace App\Livewire\Personal;

use App\Models\Medical;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListEspecialista extends Component
{
    use WithPagination;

    public $show = false;

    public function mount($show)
    {
        $this->show = $show;

    }

    public function render()
    {
        return view('livewire.personal.list-especialista', [
            'listMedical' => Medical::listMedicals()->paginate(15),
        ]);
    }

    #[On('showModalEspecialist')]
    public function updateShow($show)
    {
        $this->show = $show;
    }
}
