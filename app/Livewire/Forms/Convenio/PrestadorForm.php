<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Convenio;

use App\Classes\Convenio\InsuranceValidation;
use App\Classes\Services\ModelService;
use App\Dto\PrestadorDto;
use App\Models\Insurance;
use App\Traits\ProvinceCity;
use Illuminate\Database\Eloquent\Model;
use Livewire\Form;

final class PrestadorForm extends Form
{
    use ProvinceCity;

    public ?PrestadorDto $dataobrasocial = null;

    private ?InsuranceValidation $validation = null;

    public function setUp(): void
    {
        $this->dataobrasocial ??= new PrestadorDto();
    }

    public function insuranceStore(): Model
    {
        $data = $this->validation()->validateServiceData(null, ($this->dataobrasocial->toArray()));

        return $this->iniService()->store($data);
    }

    public function insuranceUpdate(InsuranceValidation $insuranceValidation): array
    {
        /*$services = $this->iniService();

        return NotifyQuerys::msgUpadte($services->update(
            $insuranceValidation->onInsuranceUpdate($this->dataobrasocial), $this->dataobrasocial['id']));*/
    }

    public function infoInsurance($idInsurance): void
    {
        $services = $this->iniService();
        $dataInsurance = $services->showWithRelationship($idInsurance, 'showInsuraceRelashion');

        $this->dataobrasocial = $dataInsurance->toArray();
        $this->dataobrasocial['insurance_type_id'] = $dataInsurance->insurance_type_id;
        $this->dataobrasocial['insurance_type_name'] = $dataInsurance->insuranceType->insuratype_name;
        $this->dataobrasocial['province_id'] = $dataInsurance->city?->province->id;
        $this->dataobrasocial['city_id'] = $dataInsurance->city_id;
        if (! is_null($dataInsurance->city)) {
            $this->setProvinceCity($dataInsurance->city->province->id, $dataInsurance->city->id);
            $this->setnameProvinceCity($dataInsurance->city->province->province_name->value, $dataInsurance->city->city_name);
        }
    }

    private function validation(): InsuranceValidation
    {
        return $this->validation ??= new InsuranceValidation();
    }

    private function iniService()
    {
        return new ModelService(new Insurance);
    }
}
