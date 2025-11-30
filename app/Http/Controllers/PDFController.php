<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Classes\Services\ModelPdfService;

final class PDFController extends Controller
{
    public function pdfById($id, $type)
    {
        $modelId = decryptString($id);

        $baseclass = mb_trim('App\Classes\PdfGenerator\ ') . class_basename($type);

        return (new ModelPdfService())->generatePdfById(new $baseclass(), $modelId);

    }
}
