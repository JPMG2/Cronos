<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mainmenus = ['Registro', 'Gestión', 'Reportes', 'Configuración'];

        $registro = [
            [
                'grup_menu' => 'Comercio',
                'title_menu' => false,
                'icon_menu' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                'linkto' => '#',
                'descripcion' => 'Usuarios del sistema',
            ],
            [
                'grup_menu' => 'Personal',
                'title_menu' => false,
                'icon_menu' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                'linkto' => '#',
                'descripcion' => 'Doctor del sistema',
            ],
        ];

        $gestión = [
            [
                'grup_menu' => 'Obra Social',
                'title_menu' => false,
                'icon_menu' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                'linkto' => '#',
                'descripcion' => 'Usuarios del sistema',
            ],
        ];

        foreach ($mainmenus as $menu) {
            $newmenu = Menu::create([
                'name_menu' => $menu,
                'title_menu' => true,
            ]);
            $opcionname = str()->lower($menu);

            if (isset($$opcionname) and count($$opcionname) > 0) {
                $this->createOpcionMenu($newmenu->id, $$opcionname);
            }
        }
    }

    public function createOpcionMenu($id, $array)
    {

        $comercio = [
            [
                'grup_menu' => 'Empresa',
                'title_menu' => false,
                'icon_menu' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                'linkto' => 're_company',
                'header_menu' => 'Registro/Comercio/Empresa',
                'descripcion' => 'empresa del sistema',
            ],
            [
                'grup_menu' => 'Sucursales',
                'title_menu' => false,
                'icon_menu' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                'linkto' => 're_sucursal',
                'header_menu' => 'Registro/Comercio/Sucursales',
                'descripcion' => 'empresa del sistema',
            ],
            [
                'grup_menu' => 'Departamentos',
                'title_menu' => false,
                'icon_menu' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                'linkto' => 're_department',
                'header_menu' => 'Registro/Comercio/Departamentos',
                'descripcion' => 'empresa del sistema',
            ],

        ];

        $personal = [
            [
                'grup_menu' => 'Usuarios',
                'title_menu' => false,
                'icon_menu' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                'linkto' => '#',
                'header_menu' => 'Registro/Personal/Usuarios',
                'descripcion' => 'Doctor del sistema',
            ],
            [
                'grup_menu' => 'Especialistas',
                'title_menu' => false,
                'icon_menu' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                'header_menu' => 'Registro/Personal/Especialistas',
                'linkto' => 're_especialist',
                'descripcion' => 'Doctor del sistema',
            ],
        ];

        $obra_social = [

            [
                'grup_menu' => 'Registro',
                'title_menu' => false,
                'icon_menu' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                'linkto' => 're_obrasocial',
                'header_menu' => 'Gestión/Obra Social/Registro',
                'descripcion' => 'Planes de Obras Sociales del sistema',
            ],

        ];

        foreach ($array as $opcion) {
            $opcion['menu_id'] = $id;
            $submenu = Menu::create($opcion);
            $arraysubmenu = str_replace(' ', '_', str()->lower($opcion['grup_menu']));

            if ((isset($$arraysubmenu)) and count($$arraysubmenu) > 0) {
                $this->createOpcionMenu($submenu->id, $$arraysubmenu);
            }
        }
    }
}
