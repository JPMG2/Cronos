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

    /**
     * Store a new insurance record.
     *
     * This method creates a new insurance record with the provided data.
     * It validates the data using the InsuranceValidation object and then stores
     * the insurance record using the InsuranceObj object. The created insurance
     * record is then returned as a response message.
     *
     * @param  InsuranceObj  $insuranceObj  The insurance object used to store the record.
     * @param  InsuranceValidation  $insuranceValidation  The validation object used to validate the data.
     * @return array The response message after creating the insurance record.
     */
    public function insuranceStore(InsuranceObj $insuranceObj, InsuranceValidation $insuranceValidation): array
    {
        return NotifyQuerys::msgCreate($insuranceObj->store($insuranceValidation->onInsuranceCreate($this->dataobrasocial)));
    }

    /**
     * Update the specified insurance record.
     *
     * This method updates an existing insurance record with the provided data.
     * It validates the data using the InsuranceValidation object and then updates
     * the insurance record using the InsuranceObj object. The updated insurance
     * record is then returned as a response message.
     *
     * @param  InsuranceObj  $insuranceObj  The insurance object used to update the record.
     * @param  InsuranceValidation  $insuranceValidation  The validation object used to validate the data.
     * @return array The response message after updating the insurance record.
     */
    public function insuranceUpdate(InsuranceObj $insuranceObj, InsuranceValidation $insuranceValidation): array
    {
        return NotifyQuerys::msgUpadte($insuranceObj->update(
            $insuranceValidation->onInsuranceUpdate($this->dataobrasocial), $this->dataobrasocial['id']));
    }

    public function infoInsurance(InsuranceObj $insuranceObj, $idInsurance)
    {

        $dataInsurance = $insuranceObj->show($idInsurance);

        $this->dataobrasocial = $dataInsurance->toArray();
        $this->dataobrasocial['insurance_type_id'] = $dataInsurance->insurance_type_id;
        $this->dataobrasocial['insurance_type_name'] = $dataInsurance->insuranceType->insuratype_name;
        $this->dataobrasocial['province_id'] = $dataInsurance->city?->province->id;
        $this->dataobrasocial['city_id'] = $dataInsurance->city_id;
        if (! is_null($dataInsurance->city)) {
            $this->setProvinceCity($dataInsurance->city->province->id, $dataInsurance->city->id);
            $this->setnameProvinceCity($dataInsurance->city->province->province_name, $dataInsurance->city->city_name);
        }
    }
}
