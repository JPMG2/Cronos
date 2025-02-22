<?php

namespace App\Livewire\Forms\Registro;

use App\Classes\Registro\BranchObj;
use App\Classes\Registro\BranchValidation;
use App\Classes\Utilities\NotifyQuerys;
use App\Traits\ProvinceCity;
use Livewire\Form;

class BranchForm extends Form
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

    public function branchStore(BranchValidation $branchValidation, BranchObj $branchObj): array
    {
        return NotifyQuerys::msgCreate($branchObj->store($branchValidation->onBranchCreate($this->databranch)));
    }

    public function branchUpdate(BranchValidation $branchValidation, BranchObj $branchObj): array
    {

        return NotifyQuerys::msgUpadte($branchObj->update($branchValidation->onBranchUpdate($this->databranch), $this->databranch['id']));

    }

    public function infoBranc(BranchObj $branchObj, $branchId)
    {
        $brancData = $branchObj->show($branchId);
        if ($brancData) {
            $this->databranch = $brancData->toArray();
            $this->setProvinceCity($brancData->city->province->id, $brancData->city->id);
            $this->setnameProvinceCity($brancData->city->province->province_name, $brancData->city->city_name);

        }

    }
}
