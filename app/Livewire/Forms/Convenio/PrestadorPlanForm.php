<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Convenio;

use App\Classes\Utilities\AttributeValidator;
use Illuminate\Support\Facades\Validator;
use Livewire\Form;

final class PrestadorPlanForm extends Form
{
    public array $dataPrestadorPlan = [
        'id' => null,
        'insurance_id' => null,
        'state_id' => 1,
        'insurance_plan_name' => '',
        'insurance_plan_code' => '',
        'insurance_start_date' => '',
        'insurance_end_date' => '',
        'insurance_plan_description' => '',
        'authorisation' => '',
        'insurance_plan_condition' => '',
        'insurance_name' => '',
    ];

    public function prestadorPlanUpdate() {}

    public function prestadorPlanStore()
    {
        $data = $this->validateServiceData();
    }

    protected function getValidationAttributes(): array
    {
        return [
            'insurance_plan_name' => config('nicename.name'),
            'insurance_plan_code' => config('nicename.codigo'),
        ];
    }

    private function validateServiceData(?int $excludeId = null): array
    {
        return Validator::make(
            $this->transformServiceData(),
            $this->getValidationRules($excludeId),
            [],
            $this->getValidationAttributes()
        )->validate();
    }

    private function transformServiceData(): array
    {
        return [
            'insurance_plan_code' => mb_strtoupper(mb_trim($this->dataPrestadorPlan['insurance_plan_code'])),
            'insurance_plan_name' => ucwords(mb_strtolower(mb_trim($this->dataPrestadorPlan['insurance_plan_name']))),
            'insurance_plan_description' => ucfirst(mb_strtolower(mb_trim($this->dataPrestadorPlan['insurance_plan_description']))),
            'insurance_start_date' => $this->dataPrestadorPlan['insurance_start_date'],
            'insurance_end_date' => $this->dataPrestadorPlan['insurance_end_date'],
            'insurance_plan_condition' => ucfirst(mb_strtolower(mb_trim($this->dataPrestadorPlan['insurance_plan_condition']))),
            'authorisation' => $this->dataPrestadorPlan['authorisation'],
            'insurance_id' => $this->dataPrestadorPlan['insurance_id'],
            'state_id' => $this->dataPrestadorPlan['state_id'],
        ];
    }

    private function getValidationRules(?int $excludeId = null): array
    {
        return [
            'insurance_plan_code' => AttributeValidator::uniqueIdNameLength(2, 'insurance_plans', 'insurance_plan_code', $excludeId),
            'insurance_plan_name' => AttributeValidator::uniqueIdNameLength(3, 'insurance_plans', 'insurance_plan_name', $excludeId),
        ];
    }
}
