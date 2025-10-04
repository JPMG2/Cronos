<?php

declare(strict_types=1);

namespace App\Classes\PdfGenerator;

use App\Interfaces\ModelPdfGenerator;
use App\Models\Company;
use App\Models\Medical;
use Barryvdh\DomPDF\Facade\Pdf;

final class MedicPdf implements ModelPdfGenerator
{
    public function generatePdfById($id)
    {
        $data = [
            'title' => 'Especialista',
            'content' => Medical::find($id),
            'company' => Company::first(),
        ];

        return Pdf::loadView('pdfs.medicdata', $data)
            ->stream('especialista.pdf');
    }

    public function generatePdfByValues() {}
}
