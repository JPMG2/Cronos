<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

final class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mainmenus = ['Registro', 'Convenios', 'Servicios', 'Reportes', 'Configuración'];

        $registro = [
            [
                'grup_menu' => 'Comercio',
                'title_menu' => false,
                'icon_menu' => 'M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z',
                'linkto' => '#',
                'descripcion' => 'Usuarios del sistema',
            ],
            [
                'grup_menu' => 'Maestros',
                'title_menu' => false,
                'icon_menu' => 'M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z',
                'linkto' => '#',
                'descripcion' => 'Doctor del sistema',
            ],
        ];

        $convenios = [
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
                'grup_menu' => 'Seguridad',
                'title_menu' => false,
                'icon_menu' => 'M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z',
                'linkto' => '#',
                'descripcion' => 'Usuarios del sistema',
            ],

            [
                'grup_menu' => 'Operativo',
                'title_menu' => false,
                'icon_menu' => 'M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z',
                'linkto' => '#',
                'descripcion' => 'Usuarios del sistema',
            ],

        ];

        $servicios = [
            [
                'grup_menu' => 'Clínico',
                'title_menu' => false,
                'icon_menu' => 'M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3',
                'linkto' => '#',
                'descripcion' => 'Opciones del manejo de servicos de salud',
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

        $maestros = [
            [
                'grup_menu' => 'Usuarios',
                'title_menu' => false,
                'icon_menu' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                'linkto' => 're_user',
                'header_menu' => 'Registro/Maestro/Usuarios',
                'descripcion' => 'Doctor del sistema',
            ],
            [
                'grup_menu' => 'Especialistas',
                'title_menu' => false,
                'icon_menu' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                'header_menu' => 'Registro/Maestro/Especialistas',
                'linkto' => 're_especialist',
                'descripcion' => 'Doctor del sistema',
            ],
            [
                'grup_menu' => 'Servicios',
                'title_menu' => false,
                'icon_menu' => 'M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z',
                'linkto' => 're_service',
                'header_menu' => 'Registro/Maestro/Servicios',
                'descripcion' => 'Registro de servicio ',

            ],
        ];

        $obra_social = [

            [
                'grup_menu' => 'Registro',
                'title_menu' => false,
                'icon_menu' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                'linkto' => 're_obrasocial',
                'header_menu' => 'Convenios/Obra Social/Registro',
                'descripcion' => 'Planes de Obras Sociales del sistema',
            ],

        ];
        $seguridad = [
            [
                'grup_menu' => 'Roles',
                'title_menu' => false,
                'icon_menu' => 'M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z',
                'linkto' => 're_confrole',
                'header_menu' => 'Configuración/Seguridad/Roles',
                'descripcion' => 'ReRoles del sistema',
            ],
            [
                'grup_menu' => 'Permisos',
                'title_menu' => false,
                'icon_menu' => 'M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z',
                'linkto' => 're_confper',
                'header_menu' => 'Configuración/Seguridad/Permisos',
                'descripcion' => 'ReRoles del sistema',

            ],
            [
                'grup_menu' => 'Accesos',
                'title_menu' => false,
                'icon_menu' => 'M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z',
                'linkto' => 're_acceso',
                'header_menu' => 'Configuración/Seguridad/Accesos',
                'descripcion' => 'ReRoles del sistema',

            ],
        ];
        $operativo = [
            [
                'grup_menu' => 'Feriados',
                'title_menu' => false,
                'icon_menu' => 'M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z',
                'linkto' => 're_feriado',
                'header_menu' => 'Configuración/Operativo/Feriados',
                'descripcion' => 'ReRoles del sistema',

            ],
            [
                'grup_menu' => 'Horario',
                'title_menu' => false,
                'icon_menu' => 'M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z',
                'linkto' => 're_horario',
                'header_menu' => 'Configuración/Operativo/Horario',
                'descripcion' => 'ReRoles del sistema',

            ],
        ];
        $clínico = [
            [
                'grup_menu' => 'Pacientes',
                'title_menu' => false,
                'icon_menu' => 'M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z',
                'linkto' => 're_paciente',
                'header_menu' => 'Servicios/Clínico/Pacientes',
                'descripcion' => 'Registro de pacientes ',

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
