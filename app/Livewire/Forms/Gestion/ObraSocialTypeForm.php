<?php

namespace App\Livewire\Forms\Gestion;

use App\Classes\Services\ModelService;
use App\Classes\Utilities\AttributeValidator;
use App\Classes\Utilities\NotifyQuerys;
use App\Models\InsuranceType;
use Illuminate\Support\Facades\Validator;
use Livewire\Form;

class ObraSocialTypeForm extends Form
{
    public $insuratypedata = [
        'insuratype_name' => '',
    ];

    public function insuratypeStore()
    {
        $validated = Validator::make(
            ['insuratype_name' => ucwords(strtolower(trim($this->insuratypedata['insuratype_name']))),
            ],
            ['insuratype_name' => AttributeValidator::uniqueIdNameLength(5, 'insurance_types', 'insuratype_name', null),
            ],
            [],
            ['insuratype_name' => config('nicename.name')]
        )->validate();

        $services = $this->iniService();

        return NotifyQuerys::msgCreate($services->store($validated));
    }

    public function insuratypeUpdate()
    {
        $validated = Validator::make(
            ['insuratype_name' => ucwords(strtolower(trim($this->insuratypedata['insuratype_name']))),
            ],
            ['insuratype_name' => AttributeValidator::uniqueIdNameLength(5, 'insurance_types', 'insuratype_name', $this->insuratypedata['id']),
            ],
            [],
            ['insuratype_name' => config('nicename.name')]
        )->validate();

        $services = $this->iniService();

        return NotifyQuerys::msgUpadte($services->update($this->insuratypedata, $this->insuratypedata['id']));
    }

    public function insuranceData($idInsuraType)
    {
        $services = $this->iniService();

        $data = $services->show($idInsuraType);

        $this->insuratypedata = $data->toArray();
    }

    protected function iniService()
    {
        return app()->make(ModelService::class, ['model' => new InsuranceType]);
    }
}
