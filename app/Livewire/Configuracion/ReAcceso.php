<?php

declare(strict_types=1);

namespace App\Livewire\Configuracion;

use App\Livewire\Forms\Configuracion\AccesoForm;
use App\Models\Menu;
use Illuminate\Support\Arr;
use Livewire\Attributes\Title;
use Livewire\Component;

final class ReAcceso extends Component
{
    public AccesoForm $accesoForm;

    public $nameMenu;

    public $listOptionMenu = [];

    public $idOptionMenu = [];

    public $idMenu;

    #[Title(' - Accesos')]
    public function render()
    {

        $this->commonQuerys = app('commonquery');

        return view(
            'livewire.configuracion.re-acceso',
            [
                'listRoles' => $this->commonQuerys::listRoles(['Owner']),
                'listMenus' => Menu::whereNull('menu_id')->orderBy('id')->get(),
            ]
        );
    }

    public function cabezeraMenu($idMenu)
    {
        if (in_array($idMenu, $this->accesoForm->dataacceso['menu_id'], true)) {
            $this->accesoForm->dataacceso['menu_id'] = array_diff($this->accesoForm->dataacceso['menu_id'], [$idMenu]);
        } else {
            $this->accesoForm->dataacceso['menu_id'][] = $idMenu;
        }
    }

    public function removeItemMenu($idMenu)
    {

        unset($this->listOptionMenu[$idMenu]);
        $menus = Menu::find($idMenu);
        $menus->menus;
        foreach ($menus->menus as $menu) {
            if (in_array($menu->id, $this->accesoForm->dataacceso['menu_options'], true)) {
                $this->accesoForm->dataacceso['menu_options'] =
                    array_values(array_diff($this->accesoForm->dataacceso['menu_options'], [$menu->id]));
            }
        }

    }

    public function queryActionAccion()
    {
        $result = app()->call([$this->accesoForm, 'checkAccesRoles']);
        $this->endAction($result);
    }

    public function endAction($result)
    {
        $this->dispatch('show-toast', $result);
        $this->clearForm();

    }

    public function clearForm()
    {
        $this->accesoForm->reset();
    }

    public function loadMenus()
    {
        $items = app()->call([$this->accesoForm, 'dataRoleMenu']);

        if (count($items) > 0) {
            foreach ($items as $item) {
                $this->showMenu(Menu::find($item));
            }

        }
    }

    public function showMenu(Menu $menu)
    {

        $this->idMenu = $menu->id;
        $this->nameMenu = $menu->grup_menu;
        $this->listOptionMenu = $menu->menus;
        $this->idOptionMenu = Arr::mapWithKeys(
            $this->listOptionMenu->toArray(),
            static function (array $item, int $key) {
                return [$item['id'] => $item['id']];
            }
        );

    }
}
