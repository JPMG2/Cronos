<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Convenio;

use Livewire\Form;

final class PrestadorPlanForm extends Form
{
    public array $dataPrestadorPlan = [
        'insurance_id' => null,
        'state_id' => 1,
        'insurance_plan_name' => '',
        'insurance_plan_code' => '',
        'insurance_start_date' => '',
        'insurance_end_date' => '',
        'insurance_plan_description' => '',
        'authorisation' => '',
        'insurance_plan_condition' => '',
    ];
}
