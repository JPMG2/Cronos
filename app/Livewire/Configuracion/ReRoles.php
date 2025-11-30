<?php

declare(strict_types=1);

namespace App\Livewire\Configuracion;

use App\Classes\Utilities\AlertModal;
use App\Classes\Utilities\NotifyQuerys;
use App\Livewire\Forms\Configuracion\RoleForm;
use App\Models\Role;
use App\Traits\HandleMenuAction;
use App\Traits\UtilityForm;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
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
    public function render(): Factory|View
    {
        $this->commonQuerys = app('commonquery');

        return view(
            'livewire.configuracion.re-roles',
            [
                'listRoles' => $this->commonQuerys::listRoles(['Owner']),
            ],
        );
    }

    #[Computed]
    public function countRoles()
    {
        return Role::countRoles();
    }

    public function editRoles(Role $role): void
    {
        $this->showRoleModal = true;
        $this->isupdate = true;
        $this->roleForm->roleData($role);
    }

    public function roleQuery(): void
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

    public function deleteRole(Role $role): void
    {
        $this->messageWindow(
            $role,
            function ($role): AlertModal {
                if (! empty($this->checkRoleAssignment($role)['message'])) {
                    return $this->dataAlert('error', 'Error', '', '', $this->checkRoleAssignment($role)['message'], 0);
                }

                return $this->dataAlert('warning', 'Advertencia', 'roleRemove', 'Borrar', 'Realmente desea borrar el rol ?', $role->id);

            },
        );
    }

    #[On('roleRemove')]
    public function remove(): void
    {
        $this->endRoles(NotifyQuerys::msgDestroy(Role::destroy($this->idRemove)));
    }

    private function checkRoleAssignment($role): array
    {
        if ($role->users()->count() > 0) {
            return ['message' => 'No se puede eliminar el rol, tiene usuarios asignados'];
        }
        if ($role->actions()->count() > 0) {
            return ['message' => 'No se puede eliminar el rol, tiene acciones asignadas'];
        }

        return ['message' => ''];
    }
}
