<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\MaritalStatus;
use Illuminate\Database\Seeder;

final class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $martialstatus = [
            ['maritalstatus_name' => 'Soltero'],
            ['maritalstatus_name' => 'Casado'],
            ['maritalstatus_name' => 'Divorciado'],
            ['maritalstatus_name' => 'Viudo'],
            ['maritalstatus_name' => 'Unión Libre'],
        ];
        foreach ($martialstatus as $value) {
            MaritalStatus::create($value);
        }
    }
}
