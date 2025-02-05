<?php

namespace App\Interfaces;

interface ModelPdfGenerator
{
    public function generatePdfById($id);

    public function generatePdfByValues();
}
