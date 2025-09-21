<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Registro;

use App\Classes\Utilities\AttributeValidator;
use App\Classes\Utilities\QueryRepository;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Livewire\Form;

final class DepartmentForm extends Form
{
    public array $datadeparment = [
        'department_name' => '',
        'department_code' => '',

    ];

    public function departmentStore(): Model
    {
        $data = $this->validateServiceData();

        return $this->iniService()->create($data);
    }

    public function departmentUpdate(): Model
    {
        $data = $this->validateServiceData($this->datadeparment['id']);

        return $this->iniService()->update($this->datadeparment['id'], $data);
    }

    public function loadDataDepartment($department): void
    {
        $this->datadeparment = $department->toArray();
    }

    protected function getValidationAttributes(): array
    {
        return [
            'department_name' => config('nicename.departamento'),
            'department_code' => config('nicename.codigo'),
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
            'department_name' => ucwords(mb_strtolower(mb_trim($this->datadeparment['department_name']))),
            'department_code' => mb_strtoupper(mb_trim($this->datadeparment['department_code'])),
        ];
    }

    private function getValidationRules(?int $excludeId = null): array
    {
        return [
            'department_name' => AttributeValidator::uniqueIdNameLength(3, 'departments', 'department_name', $excludeId),
            'department_code' => AttributeValidator::uniqueIdNameLength(3, 'departments', 'department_code', $excludeId),
        ];
    }

    private function iniService()
    {
        return new QueryRepository(new Department());
    }
}
