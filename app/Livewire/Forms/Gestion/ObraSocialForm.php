<?php

namespace App\Livewire\Forms\Gestion;

use App\Classes\Gestion\InsuranceObj;
use App\Classes\Gestion\InsuranceValidation;
use App\Classes\Utilities\NotifyQuerys;
use App\Traits\ProvinceCity;
use Livewire\Form;

class ObraSocialForm extends Form
{
    use ProvinceCity;

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
        'insurance_type_name' => '',
    ];

    public function insuranceStore(InsuranceObj $insuranceObj, InsuranceValidation $insuranceValidation): array
    {
        return NotifyQuerys::msgCreate($insuranceObj->store($insuranceValidation->onInsuranceCreate($this->dataobrasocial)));
    }

    public function infoInsurance(InsuranceObj $insuranceObj, $idInsurance)
    {
        $dataInsurance = $insuranceObj->show($idInsurance);
        $this->dataobrasocial = $dataInsurance->toArray();
        $this->dataobrasocial['insurance_type_id'] = $dataInsurance->insurance_type_id;
        $this->dataobrasocial['insurance_type_name'] = $dataInsurance->insuranceType->insuratype_name;
        $this->dataobrasocial['province_id'] = $dataInsurance->city?->provice->id;
        $this->dataobrasocial['city_id'] = $dataInsurance->city_id;
        if (! is_null($dataInsurance->city)) {
            $this->setProvinceCity($dataInsurance->city->province->id, $dataInsurance->city->id);
            $this->setnameProvinceCity($dataInsurance->city->province->province_name, $dataInsurance->city->city_name);
        }
    }
}
