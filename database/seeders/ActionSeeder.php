<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Seeder;

final class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayAction = [
            ['action_name' => 'created', 'action_sp' => 'Crear', 'action_inpass' => 'ha creado'],
            ['action_name' => 'updated', 'action_sp' => 'Actualizar', 'action_inpass' => 'ha actualizado'],
            ['action_name' => 'view', 'action_sp' => 'Consultar', 'action_inpass' => 'ha consultado'],
            ['action_name' => 'deleted', 'action_sp' => 'Borrar', 'action_inpass' => 'ha eliminado'],
            ['action_name' => 'print', 'action_sp' => 'Imprimir', 'action_inpass' => 'ha impreso'],
            ['action_name' => 'export', 'action_sp' => 'Exportar', 'action_inpass' => 'ha exportado'],
            ['action_name' => 'import', 'action_sp' => 'Importar', 'action_inpass' => 'ha importado'],
            ['action_name' => 'history', 'action_sp' => 'Historial', 'action_inpass' => 'ha visto historial'],
            ['action_name' => 'refresh', 'action_sp' => 'Refrescar', 'action_inpass' => 'ha refrescado'],
            ['action_name' => 'login', 'action_sp' => '', 'action_inpass' => 'ha ingresado al sistema'],
            ['action_name' => 'logout', 'action_sp' => '', 'action_inpass' => 'ha salido del sistema'],
        ];

        foreach ($arrayAction as $action) {
            Action::create($action);
        }
    }
}
