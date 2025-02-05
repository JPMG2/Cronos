<?php

namespace App\Livewire\Home;

use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Title('- Inicio')]
    public function render()
    {
        return view('livewire.home.dashboard');
    }
}
