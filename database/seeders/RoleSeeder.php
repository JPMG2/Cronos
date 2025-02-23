<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name_role' => 'Owner',
                'description' => 'Usuario con autoridad total sobre la configuración, seguridad y gestión del sistema web',
            ],
            [
                'name_role' => 'Administrator',
                'description' => 'Usuario con autoridad total sobre la gestión de usuarios y roles',
            ],
            [
                'name_role' => 'Auditor',
                'description' => 'Usuario con autoridad total sobre la gestión de auditorías',
            ],
            [
                'name_role' => 'Operator',
                'description' => 'Usuario con autoridad total sobre la gestión de operaciones',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
