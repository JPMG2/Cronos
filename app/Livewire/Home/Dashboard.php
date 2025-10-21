<?php

declare(strict_types=1);

namespace App\Livewire\Home;

use Livewire\Attributes\Title;
use Livewire\Component;

final class Dashboard extends Component
{
    #[Title('- Inicio')]
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.home.dashboard');
    }
}
