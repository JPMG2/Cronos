<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Configuracion;

use App\Classes\Services\ModelService;
use App\Classes\Utilities\NotifyQuerys;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Livewire\Form;

final class AccesoForm extends Form
{
    public $dataacceso = [
        'role_id' => '',
        'menu_id' => [],
        'menu_options' => [],
    ];

    public function checkAccesRoles()
    {
        Validator::make(
            [
                'role_id' => $this->dataacceso['role_id'],
                'menu_options' => $this->dataacceso['menu_options'],
            ],
            [
                'role_id' => 'required|gt:0',
                'menu_options' => 'required|array|min:1',
            ],
            [],
            [
                'role_id' => config('nicename.role'),
                'menu_options' => config('nicename.acceso'),
            ]
        )->validate();

        Role::query()->find($this->dataacceso['role_id']);
        $uniqueMenuIds = [];
        $menuId = Menu::query()->whereIn('id', $this->dataacceso['menu_id'])->select('menu_id')->get();
        foreach ($menuId as $value) {
            if (! in_array($value->menu_id, $uniqueMenuIds, true)) {
                $uniqueMenuIds[] = $value->menu_id;
            }
        }
        $allMenuIds = array_merge($uniqueMenuIds, $this->dataacceso['menu_id'], $this->dataacceso['menu_options']);

        $services = $this->iniService();

        return NotifyQuerys::msgCreateUpdateMany($services
            ->addWithRelationship((int) $this->dataacceso['role_id'],
                $allMenuIds,
                'menus'
            ));

    }

    public function dataRoleMenu(): array
    {
        $menusId = [];
        $menuOptions = [];
        $role = Role::query()->find($this->dataacceso['role_id']);
        if ($role->menus->count() > 0) {
            foreach ($role->menus as $value) {
                if (is_null($value->header_menu) && $value->menu_id > 0) {
                    $menusId[] = $value->id;
                }
                if (! empty($value->grup_menu) && ! empty($value->header_menu)) {
                    $menuOptions[] = $value->id;
                }

            }
            $this->dataacceso['menu_id'] = $menusId;
            $this->dataacceso['menu_options'] = $menuOptions;

        } else {
            $this->dataacceso['menu_id'] = [];
            $this->dataacceso['menu_options'] = [];
        }

        return $this->dataacceso['menu_id'];

    }

    private function iniService()
    {
        return new ModelService(new Role);
    }
}
