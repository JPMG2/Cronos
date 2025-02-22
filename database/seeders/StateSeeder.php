<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $state = [
            ['state_name' => 'Activo'],
            ['state_name' => 'Bloqueado'],
            ['state_name' => 'Eliminado'],
            ['state_name' => 'Suspendido'],
        ];
        foreach ($state as $datastate) {
            State::create($datastate);
        }
    }
}
