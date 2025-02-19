<?php

namespace App\Livewire\Forms\Gestion;

use App\Classes\Gestion\InsuranceTypeObj;
use App\Classes\Utilities\AttributeValidator;
use App\Classes\Utilities\NotifyQuerys;
use Illuminate\Support\Facades\Validator;
use Livewire\Form;

class ObraSocialTypeForm extends Form
{
    public $insuratypedata = [
        'insuratype_name' => '',
    ];

    public function insuratypeStore(InsuranceTypeObj $insuranceType)
    {
        $validated = Validator::make(
            ['insuratype_name' => ucwords(strtolower(trim($this->insuratypedata['insuratype_name']))),
            ],
            ['insuratype_name' => AttributeValidator::uniqueIdNameLength(5, 'insurance_types', 'insuratype_name', null),
            ],
            [],
            ['insuratype_name' => config('nicename.name')]
        )->validate();

        return NotifyQuerys::msgCreate($insuranceType->store($validated));
    }

    public function insuratypeUpdate(InsuranceTypeObj $insuranceType)
    {
        $validated = Validator::make(
            ['insuratype_name' => ucwords(strtolower(trim($this->insuratypedata['insuratype_name']))),
            ],
            ['insuratype_name' => AttributeValidator::uniqueIdNameLength(5, 'insurance_types', 'insuratype_name', $this->insuratypedata['id']),
            ],
            [],
            ['insuratype_name' => config('nicename.name')]
        )->validate();

        return NotifyQuerys::msgUpadte($insuranceType->update($this->insuratypedata));
    }

    public function insuranceData(InsuranceTypeObj $insuranceType, $idInsuraType)
    {
        $data = $insuranceType->show($idInsuraType);

        $this->insuratypedata = $data->toArray();
    }
}
