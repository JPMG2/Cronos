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
                'icon_menu' => 'M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z',
                'linkto' => '#',
                'descripcion' => 'Usuarios del sistema',
            ],
            [
                'grup_menu' => 'Personal',
                'title_menu' => false,
                'icon_menu' => 'M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z',
                'linkto' => '#',
                'descripcion' => 'Doctor del sistema',
            ],
        ];

        $gestión = [
            [
                'grup_menu' => 'Obra Social',
                'title_menu' => false,
                'icon_menu' => 'M4.098 19.902a3.75 3.75 0 0 0 5.304 0l6.401-6.402M6.75 21A3.75 3.75 0 0 1 3 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 0 0 3.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008Z',
                'linkto' => '#',
                'descripcion' => 'Usuarios del sistema',
            ],
        ];

        $configuración = [
            [
                'grup_menu' => 'Gestión',
                'title_menu' => false,
                'icon_menu' => 'M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z',
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
        $gestión = [
            [
                'grup_menu' => 'ReRoles',
                'title_menu' => false,
                'icon_menu' => 'M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z',
                'linkto' => 're_confrole',
                'header_menu' => 'Configuración/Gestión/ReRoles',
                'descripcion' => 'ReRoles del sistema',
            ],
            [
                'grup_menu' => 'Permisos',
                'title_menu' => false,
                'icon_menu' => 'M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z',
                'linkto' => 're_confper',
                'header_menu' => 'Configuración/Gestión/Permisos',
                'descripcion' => 'ReRoles del sistema',

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
