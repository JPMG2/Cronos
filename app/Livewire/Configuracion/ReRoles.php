<?php

namespace App\Livewire\Configuracion;

use App\Livewire\Forms\Configuracion\RoleForm;
use App\Models\Role;
use App\Traits\HandleDeleteId;
use App\Traits\UtilityForm;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class ReRoles extends Component
{
    use HandleDeleteId, UtilityForm;

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

    public function deleteRole(Role $id)
    {
        $this->deleteModel($id, function ($id) {
            if ($id->users()->count() > 0) {
                return 0;
            }

            return 1;
        });
        /*if ($id->users()->count() > 0) {
            $this->dispatch('showModalAlert', [
                'show' => 'true',
                'title' => 'Error',
                'type' => 'error',
                'message' => 'No se puede eliminar el rol, tiene usuarios asignados',
                'button' => 0,
                'buttonName' => '',
                'event' => '',
            ]);

            return;
        }

        $this->dispatch('showModalAlert', [
            'show' => 'true',
            'title' => 'Advertencia',
            'type' => 'warning',
            'message' => 'Realmente desea borrar el rol',
            'button' => 1,
            'buttonName' => 'Borrar',
            'event' => 'roleRemove',
        ]);*/
    }

    #[On('roleRemove')]
    public function remove()
    {
        dd($this->idRemove);
    }
}
