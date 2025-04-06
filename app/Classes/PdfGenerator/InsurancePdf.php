<?php

declare(strict_types=1);

namespace App\Classes\PdfGenerator;

use App\Interfaces\ModelPdfGenerator;
use App\Models\Company;
use App\Models\Insurance;
use Barryvdh\DomPDF\Facade\Pdf;

final class InsurancePdf implements ModelPdfGenerator
{
    public function generatePdfById($id)
    {
        $data = [
            'title' => 'Obra social',
            'content' => Insurance::find($id),
            'company' => Company::first(),
        ];

        return Pdf::loadView('pdfs.branchdata', $data)
            ->stream('sucursal.pdf');
    }

    public function generatePdfByValues()
    {
        // TODO: Implement generatePdfByValues() method.
    }
}
