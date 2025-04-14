<?php

declare(strict_types=1);

namespace App\Classes\PdfGenerator;

use App\Interfaces\ModelPdfGenerator;
use App\Models\Company;
use App\Models\Person;
use Barryvdh\DomPDF\Facade\Pdf;

final class PatientPdf implements ModelPdfGenerator
{
    public function generatePdfById($id)
    {

        $data = (new Person())->showDataPatient((int) $id);
        $data = [
            'title' => 'Paciente',
            'content' => $data,
            'company' => Company::first(),
        ];

        return Pdf::loadView('pdfs.patientdata', $data)
            ->stream('paciente.pdf');
    }

    public function generatePdfByValues()
    {
        // TODO: Implement generatePdfByValues() method.
    }
}
