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
    use HandleMenuAction;
    use UtilityForm;

    public RoleForm $roleForm;

    public $showRoleModal = false;

    #[Title(' - Roles')]
    public function render()
    {
        $this->commonQuerys = app('commonquery');

        return view(
            'livewire.configuracion.re-roles',
            [
                'listRoles' => $this->commonQuerys::listRoles(['Owner']),
            ]
        );
    }

    public function getCountRolesProperty()
    {
        return Role::countRoles();
    }

    public function editRoles(Role $role)
    {
        $this->showRoleModal = true;
        $this->isupdate = true;
        $this->roleForm->roleData($role);
    }

    public function roleQuery()
    {
        $result = $this->isupdate ?
            $this->roleForm->roleUpdate() :
            $this->roleForm->roleStore();
        $messageType = $this->isupdate ? 'msgUpdate' : 'msgCreate';
        $message = $this->showQueryMessage($result, $messageType);
        $this->showToastAndClear($message);
        $this->clearForm();
    }

    public function clearForm(): void
    {
        $this->roleForm->reset();
        $this->isupdate = false;
        $this->showRoleModal = false;
    }

    public function deleteRole(Role $role)
    {
        $this->messageWindow(
            $role,
            function ($role) {
                if (! empty($this->checkRoleAssignment($role)['message'])) {
                    return new AlertModal(
                        exception: 0,
                        type: 'error',
                        title: 'Error',
                        buttonName: '',
                        event: '',
                        message: $this->checkRoleAssignment($role)['message'],
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
            }
        );
    }

    #[On('roleRemove')]
    public function remove()
    {
        $this->endRoles(NotifyQuerys::msgDestroy(Role::destroy($this->idRemove)));
    }

    private function checkRoleAssignment($role): array
    {
        if ($role->users()->count() > 0) {
            return ['message' => (string) 'No se puede eliminar el rol, tiene usuarios asignados'];
        }
        if ($role->actions()->count() > 0) {
            return ['message' => (string) 'No se puede eliminar el rol, tiene acciones asignadas'];
        }

        return ['message' => (string) ''];
    }
}
