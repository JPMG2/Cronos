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
            ['name_role' => 'Owner'],
            ['name_role' => 'Administrator'],
            ['name_role' => 'Auditor'],
            ['name_role' => 'Operator'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
