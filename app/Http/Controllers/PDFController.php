<?php

namespace App\Http\Controllers;

use App\Classes\Services\ModelPdfService;

class PDFController extends Controller
{
    public function pdfById($id, $type)
    {
        $modelId = decryptString($id);

        $baseclass = trim('App\Classes\PdfGenerator\ ').class_basename($type);

        return (new ModelPdfService)->generatePdfById(new $baseclass, $modelId);

    }
}
