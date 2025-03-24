<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Seeder;

final class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = [
            ['document_name' => 'DNI'],
            ['document_name' => 'Pasaporte'],
            ['document_name' => 'Cédula'],
        ];
        foreach ($documents as $document) {
            Document::create($document);
        }
    }
}
