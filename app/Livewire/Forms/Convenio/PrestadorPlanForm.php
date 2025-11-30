<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Convenio;

use App\Classes\Convenio\MaindPrestador;
use App\Classes\Convenio\MaindPrestadorPlan;
use App\Classes\Utilities\AttributeValidator;
use App\Models\InsurancePlan;
use App\Traits\UtilityForm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Livewire\Form;

final class PrestadorPlanForm extends Form
{
    use UtilityForm;

    public array $dataPrestadorPlan = [
        'id' => null,
        'insurance_id' => null,
        'state_id' => 1,
        'insurance_plan_name' => '',
        'insurance_plan_code' => '',
        'insurance_start_date' => '',
        'insurance_end_date' => '',
        'insurance_plan_description' => ' ',
        'authorisation' => true,
        'insurance_plan_condition' => ' ',
        'insurance_name' => '',
    ];

    private ?MaindPrestador $prestador = null;

    private ?MaindPrestadorPlan $insuranceMainPlan = null;

    public function prestadorPlanUpdate(): Model
    {
        $data = $this->validateServiceData();

        $insurancePlan = $this->idPrestadorPlan((int) $this->dataPrestadorPlan['id']);

        $insurancePlan->update($this->getValues($data));

        return $insurancePlan;
    }

    public function prestadorPlanStore(): InsurancePlan
    {

        $data = $this->validateServiceData();

        $insurance = $this->prestador()->find((int) $this->dataPrestadorPlan['insurance_id']);

        return $insurance->insurancePlans()->create($this->getValues($data));

    }

    public function prestadorPlanData(int $idPrestadorPlan): void
    {
        $data = $this->insuranceMainPlan()->showProvedorPlanInfo($idPrestadorPlan);
        $this->dataPrestadorPlan = prepareData($data->toArray(), array_keys($this->dataPrestadorPlan));
        $this->dataPrestadorPlan['insurance_name'] = $data->insurance->insurance_name;

    }

    protected function getValidationAttributes(): array
    {
        return [
            'insurance_id' => config('nicename.prestador'),
            'insurance_plan_name' => config('nicename.name'),
            'insurance_plan_code' => config('nicename.codigo'),
            'insurance_start_date' => config('nicename.fechainicio'),
            'insurance_end_date' => config('nicename.fechafin'),
            'insurance_plan_description' => config('nicename.descripcion'),
            'insurance_plan_condition' => config('nicename.condicion'),
        ];
    }

    private function validateServiceData(): array
    {
        return Validator::make(
            $this->transformServiceData(),
            $this->getValidationRules($this->dataPrestadorPlan),
            [],
            $this->getValidationAttributes(),
        )->validate();
    }

    private function transformServiceData(): array
    {
        return [
            'insurance_plan_code' => mb_strtoupper(mb_trim($this->dataPrestadorPlan['insurance_plan_code'])),
            'insurance_plan_name' => mb_strtoupper(mb_trim($this->dataPrestadorPlan['insurance_plan_name'])),
            'insurance_start_date' => $this->dataPrestadorPlan['insurance_start_date'],
            'insurance_end_date' => $this->dataPrestadorPlan['insurance_end_date'],
            'insurance_plan_description' => ucfirst(mb_strtolower(mb_trim($this->dataPrestadorPlan['insurance_plan_description']))),
            'insurance_plan_condition' => ucfirst(mb_strtolower(mb_trim($this->dataPrestadorPlan['insurance_plan_condition']))),
            'authorisation' => $this->dataPrestadorPlan['authorisation'],
            'insurance_id' => $this->dataPrestadorPlan['insurance_id'],
            'state_id' => $this->dataPrestadorPlan['state_id'],
        ];
    }

    private function getValidationRules(array $data): array
    {
        return [
            'insurance_id' => AttributeValidator::requireAndExists('insurances', 'id', 'id', true),
            'insurance_plan_code' => AttributeValidator::idRelationUnique(new InsurancePlan(), (int) $data['insurance_id'], $data['id'], 'insurance_plan_code', 'insurance_id'),
            'insurance_plan_name' => AttributeValidator::idRelationUnique(new InsurancePlan(), (int) $data['insurance_id'], $data['id'], 'insurance_plan_name', 'insurance_id', 'nombre'),
            'insurance_start_date' => AttributeValidator::dateValid(true),
            'insurance_end_date' => AttributeValidator::dateAfther(false, $data['insurance_start_date']),
            'insurance_plan_description' => AttributeValidator::stringValid(false, 4),
            'insurance_plan_condition' => AttributeValidator::stringValid(false, 4),
            'authorisation' => AttributeValidator::booleanValue(true),
            'state_id' => AttributeValidator::requireAndExists('states', 'id', 'id', true),
        ];
    }

    private function idPrestadorPlan($idPrestadorPlan): Model
    {
        return $this->insuranceMainPlan()->findOrfail($idPrestadorPlan);
    }

    private function insuranceMainPlan(): MaindPrestadorPlan
    {
        return $this->insuranceMainPlan ??= resolve(MaindPrestadorPlan::class);
    }

    private function getValues(array $validValues): array
    {
        return $this->getValuesModel($validValues, new InsurancePlan());
    }

    private function prestador(): MaindPrestador
    {
        return $this->prestador ??= resolve(MaindPrestador::class);
    }
}
