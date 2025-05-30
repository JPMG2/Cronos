<?php

declare(strict_types=1);

namespace App\Interfaces;

interface ModelPdfGenerator
{
    public function generatePdfById($id);

    public function generatePdfByValues();
}
