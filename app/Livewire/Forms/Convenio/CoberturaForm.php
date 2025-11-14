<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Convenio;

use App\Dto\InsurancePlanCoverageDto;
use Livewire\Form;

final class CoberturaForm extends Form
{
    public ?InsurancePlanCoverageDto $dataCobertura;

    public function setUp(): void
    {
        $this->dataCobertura ??= new InsurancePlanCoverageDto();
    }
}
