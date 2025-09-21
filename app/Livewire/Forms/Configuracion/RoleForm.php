<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Configuracion;

use App\Classes\Utilities\AttributeValidator;
use App\Classes\Utilities\QueryRepository;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Livewire\Form;

final class RoleForm extends Form
{
    public $dataRole = [
        'name_role' => '',
        'description' => '',
    ];

    public function roleStore(): Model
    {
        $validated = $this->validateServiceData();

        return $this->iniService()->create($validated);

    }

    public function roleUpdate(): Model
    {
        $validated = $this->validateServiceData($this->dataRole['id']);

        return $this->iniService()->update($this->dataRole['id'], $validated);
    }

    public function roleData($dataRole): void
    {
        $this->dataRole = $dataRole->toArray();
    }

    protected function getValidationAttributes(): array
    {
        return [
            'name_role' => config('nicename.role'),
            'description' => config('nicename.description'),
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
            'name_role' => ucwords(mb_strtolower(mb_trim($this->dataRole['name_role']))),
            'description' => ucfirst(mb_strtolower(mb_trim($this->dataRole['description']))),
        ];
    }

    private function getValidationRules(?int $excludeId = null): array
    {
        return [
            'name_role' => AttributeValidator::uniqueIdNameLength(5, 'roles', 'name_role', $excludeId),
            'description' => AttributeValidator::stringValid(false, 4),
        ];
    }

    private function iniService()
    {
        return new QueryRepository(new Role());
    }
}
