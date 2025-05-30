<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Configuracion;

use App\Classes\Services\ModelService;
use App\Classes\Utilities\AttributeValidator;
use App\Classes\Utilities\NotifyQuerys;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Livewire\Form;

final class RoleForm extends Form
{
    public $dataRole = [
        'name_role' => '',
        'description' => '',
    ];

    public function roleStore()
    {
        $validated = Validator::make(
            [
                'name_role' => ucwords(mb_strtolower(trim($this->dataRole['name_role']))),
                'description' => ucfirst(mb_strtolower(trim($this->dataRole['description']))),
            ],
            [
                'name_role' => AttributeValidator::uniqueIdNameLength(4, 'roles', 'name_role', null),
                'description' => AttributeValidator::stringValid(false, 4),
            ],
            [],
            [
                'name_role' => config('nicename.role'),
                'description' => config('nicename.description'), ]
        )->validate();
        $services = $this->iniService();

        return NotifyQuerys::msgCreate($services->store($validated));

    }

    public function roleUpdate()
    {
        $validated = Validator::make(
            [
                'name_role' => ucwords(mb_strtolower(trim($this->dataRole['name_role']))),
                'description' => ucfirst(mb_strtolower(trim($this->dataRole['description']))),
            ],
            [
                'name_role' => AttributeValidator::uniqueIdNameLength(5, 'roles', 'name_role', $this->dataRole['id']),
                'description' => AttributeValidator::stringValid(false, 4),
            ],
            [],
            [
                'name_role' => config('nicename.role'),
                'description' => config('nicename.description'), ]
        )->validate();

        $services = $this->iniService();

        return NotifyQuerys::msgUpadte($services->update($this->dataRole, $this->dataRole['id']));
    }

    public function roleData($intRole)
    {

        $services = $this->iniService();
        $dataRole = $services->show($intRole);
        $this->dataRole = $dataRole->toArray();
    }

    protected function iniService()
    {
        return app()->make(ModelService::class, ['model' => new Role]);
    }
}
