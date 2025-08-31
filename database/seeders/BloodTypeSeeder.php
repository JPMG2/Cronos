<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\BloodType;
use Illuminate\Database\Seeder;

final class BloodTypeSeeder extends Seeder
{
    public function run(): void
    {
        $bloodTypes = [
            ['blood_type_name' => 'A+'],
            ['blood_type_name' => 'A-'],
            ['blood_type_name' => 'B+'],
            ['blood_type_name' => 'B-'],
            ['blood_type_name' => 'AB+'],
            ['blood_type_name' => 'AB-'],
            ['blood_type_name' => 'O+'],
            ['blood_type_name' => 'O-'],
        ];
        foreach ($bloodTypes as $value) {
            BloodType::create($value);
        }
    }
}
