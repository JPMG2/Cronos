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
        $validated = Validator::make(
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

        $role = Role::find($this->dataacceso['role_id']);
        $uniqueMenuIds = [];
        $menuId = Menu::whereIn('id', $this->dataacceso['menu_id'])->select('menu_id')->get();
        foreach ($menuId as $key => $value) {
            if (! in_array($value->menu_id, $uniqueMenuIds, true)) {
                $uniqueMenuIds[] = $value->menu_id;
            }
        }
        $allMenuIds = array_merge($uniqueMenuIds, $this->dataacceso['menu_id'], $this->dataacceso['menu_options']);

        $services = $this->iniService();

        return NotifyQuerys::msgCreateUpdateMany($services
            ->addWithRelastionship((int) $this->dataacceso['role_id'],
                $allMenuIds,
                'menus'
            ));

    }

    public function dataRoleMenu(): array
    {
        $menusId = [];
        $menuOptions = [];
        $role = Role::find($this->dataacceso['role_id']);
        if ($role->menus->count() > 0) {
            foreach ($role->menus as $key => $value) {
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

    protected function iniService()
    {
        return app()->make(ModelService::class, ['model' => new Role]);
    }
}
