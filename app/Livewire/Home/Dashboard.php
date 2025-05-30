<?php

declare(strict_types=1);

namespace App\Livewire\Home;

use Livewire\Attributes\Title;
use Livewire\Component;

final class Dashboard extends Component
{
    #[Title('- Inicio')]
    public function render()
    {
        return view('livewire.home.dashboard');
    }
}
