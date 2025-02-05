<?php

namespace App\Classes\Services;

use App\Interfaces\ModelPdfGenerator;

class ModelPdfService
{
    public function generatePdfById(ModelPdfGenerator $modelPdfGenerator, $id)
    {
        return $modelPdfGenerator->generatePdfById($id);
    }

    public function generatePdfByValues(ModelPdfGenerator $modelPdfGenerator)
    {
        return $modelPdfGenerator->generatePdfByValues();
    }
}
