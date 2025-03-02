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

    #[Title(' - Roles')]
    public function render()
    {
        $this->commonQuerys = app('commonquery');

        return view('livewire.configuracion.re-roles', [
            'listRoles' => $this->commonQuerys::listRoles(['Owner']),
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

    public function endRoles($result)
    {
        $this->dispatch('show-toast', $result);
        $this->clearForm();
        $this->showRoleModal = false;
    }

    public function clearForm()
    {

        $this->roleForm->reset();
        $this->isupdate = false;
    }
}
