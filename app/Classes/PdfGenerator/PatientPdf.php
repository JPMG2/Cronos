<?php

declare(strict_types=1);

namespace App\Classes\PdfGenerator;

use App\Interfaces\ModelPdfGenerator;
use App\Models\Branch;
use App\Models\Company;
use Barryvdh\DomPDF\Facade\Pdf;

final class PatientPdf implements ModelPdfGenerator
{
    public function generatePdfById($id)
    {
        $data = [
            'title' => 'Paciente',
            'content' => Branch::find($id),
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
