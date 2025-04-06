<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Registro;

use App\Classes\Registro\BranchValidation;
use App\Classes\Services\ModelService;
use App\Classes\Utilities\NotifyQuerys;
use App\Models\Branch;
use App\Traits\ProvinceCity;
use Livewire\Form;

final class BranchForm extends Form
{
    use ProvinceCity;

    public $databranch = [
        'company_id' => '',
        'state_id' => 1,
        'city_id' => 0,
        'province_id' => 0,
        'branch_name' => '',
        'branch_code' => '',
        'branch_address' => '',
        'branch_phone' => '',
        'branch_zipcode' => '',
        'branch_email' => '',
        'branch_web' => '',
        'branch_person_contact' => '',
        'branch_person_phone' => '',
        'branch_person_email' => '',

    ];

    public function branchStore(BranchValidation $branchValidation): array
    {
        $services = $this->iniService();

        return NotifyQuerys::msgCreate($services->store($branchValidation->onBranchCreate($this->databranch)));
    }

    public function branchUpdate(BranchValidation $branchValidation): array
    {
        $services = $this->iniService();

        return NotifyQuerys::msgUpadte($services->update($branchValidation->onBranchUpdate($this->databranch), $this->databranch['id']));

    }

    public function infoBranc($branchId)
    {
        $services = $this->iniService();
        $brancData = $services->showWithRelationship($branchId);
        if ($brancData) {
            $this->databranch = $brancData->toArray();
            $this->setProvinceCity($brancData->city->province->id, $brancData->city->id);
            $this->setnameProvinceCity($brancData->city->province->province_name->value(), $brancData->city->city_name);

        }

    }

    public function setIdPronvinceCity($provinceId, $cityId)
    {

        $this->databranch['province_id'] = $provinceId;
        $this->databranch['city_id'] = $cityId;
    }

    protected function iniService()
    {
        return app()->make(ModelService::class, ['model' => new Branch]);
    }
}
