<?php

namespace App\Livewire\Configuracion;

use App\Models\Role;
use Livewire\Attributes\Title;
use Livewire\Component;

class Roles extends Component
{
    #[Title(' - Roles')]
    public function render()
    {
        return view('livewire.configuracion.roles', [
            'listRoles' => Role::query()->whereNot('name_role', 'Owner')
                ->orderBy('name_role')->get(),
        ]);
    }

    public function getCountRolesProperty()
    {
        return Role::countRoles();
    }
}
