<?php

namespace App\Livewire\Configuracion;

use App\Livewire\Forms\Configuracion\RoleForm;
use App\Models\Role;
use App\Traits\UtilityForm;
use Livewire\Attributes\Title;
use Livewire\Component;

class ReRoles extends Component
{
    use UtilityForm;

    public RoleForm $roleForm;

    public $showRoleModal = false;

    #[Title(' - ReRoles')]
    public function render()
    {
        return view('livewire.configuracion.re-roles', [
            'listRoles' => Role::query()->whereNot('name_role', 'Owner')
                ->orderBy('name_role')->get(),
        ]);
    }

    public function getCountRolesProperty()
    {
        return Role::countRoles();
    }

    public function editRoles(int $idRole)
    {
        $this->showRoleModal = true;
        $this->isupdate = true;
        app()->call([$this->roleForm, 'roleData'], ['intRole' => $idRole]);
    }

    public function roleQuery()
    {

        if (! $this->isupdate) {
            $result = app()->call([$this->roleForm, 'roleStore']);
        }
        if ($this->isupdate) {
            $result = app()->call([$this->roleForm, 'roleUpdate']);
        }
        $this->endRoles($result);

    }

    public function clearForm()
    {

        $this->roleForm->reset();
        $this->isupdate = false;
    }

    public function endRoles($result)
    {
        $this->dispatch('show-toast', $result);
        $this->clearForm();
        $this->showRoleModal = false;
    }
}
