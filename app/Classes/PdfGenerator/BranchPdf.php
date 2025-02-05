<?php

namespace App\Classes\PdfGenerator;

use App\Interfaces\ModelPdfGenerator;
use App\Models\Company;
use Barryvdh\DomPDF\Facade\Pdf;

class BranchPdf implements ModelPdfGenerator
{
    public function generatePdfById($id)
    {

        $data = [
            'title' => 'Sucursal',
            'content' => 'Aqui esta el contenido.',
            'company' => Company::first(),
        ];

        return Pdf::loadView('pdfs.branchdata', $data)
            ->stream('sucursal.pdf');

    }

    public function generatePdfByValues()
    {
        return 'By Values';
    }
}
