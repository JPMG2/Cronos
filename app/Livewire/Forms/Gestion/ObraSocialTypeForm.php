<?php

namespace App\Livewire\Forms\Gestion;

use App\Classes\Gestion\InsuranceTypeObj;
use App\Classes\Utilities\NotifyQuerys;
use Illuminate\Support\Facades\Validator;
use Livewire\Form;

class ObraSocialTypeForm extends Form
{
    public $insuratype_name = '';

    public function insuratypeStore(InsuranceTypeObj $insuranceType)
    {
        $validated = Validator::make(
            ['insuratype_name' => ucwords(strtolower(trim($this->insuratype_name)))],
            ['insuratype_name' => config('validaterules.name_unique_reuired_min')(3, 'insurance_types', 'insuratype_name')],
            [],
            ['insuratype_name' => config('nicename.name')]
        )->validate();

        return NotifyQuerys::msgCreate($insuranceType->store($validated));
    }
}
