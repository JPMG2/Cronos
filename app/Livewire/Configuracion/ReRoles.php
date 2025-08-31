<?php

declare(strict_types=1);

namespace App\Livewire\Configuracion;

use App\Classes\Utilities\AlertModal;
use App\Classes\Utilities\NotifyQuerys;
use App\Livewire\Forms\Configuracion\RoleForm;
use App\Models\Role;
use App\Traits\HandleMenuAction;
use App\Traits\UtilityForm;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

final class ReRoles extends Component
{
    use HandleMenuAction, UtilityForm;

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

    public function deleteRole(Role $role)
    {
        $this->messageWindow($role, function ($role) {
            if ($role->users()->count() > 0) {
                return new AlertModal(
                    exception: 0,
                    type: 'error',
                    title: 'Error',
                    buttonName: '',
                    event: '',
                    message: 'No se puede eliminar el rol, tiene usuarios asignados',
                    idModel: 0
                );

            }

            return new AlertModal(
                exception: 1,
                type: 'warning',
                title: 'Advertencia',
                buttonName: 'Borrar',
                event: 'roleRemove',
                message: 'Realmente desea borrar el rol ?',
                idModel: $role->id
            );

        });

    }

    #[On('roleRemove')]
    public function remove()
    {
        $this->endRoles(NotifyQuerys::msgDestroy(Role::destroy($this->idRemove)));
    }
}
