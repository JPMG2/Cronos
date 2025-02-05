<?php

namespace App\Livewire\Forms\Gestion;

use App\Classes\Gestion\InsuranceObj;
use App\Classes\Gestion\InsuranceValidation;
use App\Classes\Utilities\NotifyQuerys;
use Livewire\Form;

class ObraSocialForm extends Form
{
    public $dataobrasocial = [
        'insurance_type_id' => 0,
        'state_id' => 1,
        'province_id' => 0,
        'city_id' => 0,
        'insurance_name' => '',
        'insurance_acronym' => '',
        'insurance_code' => '',
        'insurance_cuit' => '',
        'insurance_address' => '',
        'insurance_phone' => '',
        'insurance_zipcode' => '',
        'insurance_email' => '',
        'insurance_web' => '',
    ];

    public function insuranceStore(InsuranceObj $insuranceObj, InsuranceValidation $insuranceValidation): array
    {

        return NotifyQuerys::msgCreate($insuranceObj->store($insuranceValidation->onInsuranceCreate($this->dataobrasocial)));
    }
}
