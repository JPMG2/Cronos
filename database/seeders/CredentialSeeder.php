<?php

namespace Database\Seeders;

use App\Models\Credential;
use Illuminate\Database\Seeder;

class CredentialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $credential = [
            [
                'credential_name' => 'matrícula nacional',
                'credential_code' => 'MN',
            ],
            [
                'credential_name' => 'matrícula provincial',
                'credential_code' => 'MP',
            ],
        ];

        foreach ($credential as $credential) {
            Credential::create($credential);
        }
    }
}
