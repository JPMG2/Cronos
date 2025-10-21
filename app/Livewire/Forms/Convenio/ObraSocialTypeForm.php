<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Convenio;

use App\Classes\Services\ModelService;
use App\Classes\Utilities\AttributeValidator;
use App\Classes\Utilities\NotifyQuerys;
use App\Models\InsuranceType;
use Illuminate\Support\Facades\Validator;
use Livewire\Form;

final class ObraSocialTypeForm extends Form
{
    public $insuratypedata = [
        'insuratype_name' => '',
    ];

    public function insuratypeStore(): array
    {
        $validated = Validator::make(
            ['insuratype_name' => ucwords(mb_strtolower(mb_trim($this->insuratypedata['insuratype_name']))),
            ],
            ['insuratype_name' => AttributeValidator::uniqueIdNameLength(5, 'insurance_types', 'insuratype_name', null),
            ],
            [],
            ['insuratype_name' => config('nicename.name')]
        )->validate();

        $services = $this->iniService();

        return NotifyQuerys::msgCreate($services->store($validated));
    }

    public function insuratypeUpdate(): array
    {
        Validator::make(
            ['insuratype_name' => ucwords(mb_strtolower(mb_trim($this->insuratypedata['insuratype_name']))),
            ],
            ['insuratype_name' => AttributeValidator::uniqueIdNameLength(5, 'insurance_types', 'insuratype_name', $this->insuratypedata['id']),
            ],
            [],
            ['insuratype_name' => config('nicename.name')]
        )->validate();

        $services = $this->iniService();

        return NotifyQuerys::msgUpdate($services->update($this->insuratypedata, $this->insuratypedata['id']));
    }

    public function insuranceData($idInsuraType): void
    {
        $services = $this->iniService();

        $data = $services->show($idInsuraType);

        $this->insuratypedata = $data->toArray();
    }

    private function iniService()
    {
        return app()->make(ModelService::class, ['model' => new InsuranceType()]);
    }
}
