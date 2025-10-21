<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Registro;

use App\Classes\Registro\CompanyObj;
use App\Classes\Registro\CompanyValidation;
use App\Classes\Utilities\NotifyQuerys;
use App\Traits\ProvinceCity;
use App\Traits\UtilityForm;
use Livewire\Form;

final class CompanyForm extends Form
{
    use ProvinceCity;
    use UtilityForm;

    public $datacompany
        = [
            'province_id' => '',
            'city_id' => '',
            'state_id' => 1,
            'company_name' => '',
            'company_cuit' => '',
            'company_phone' => '',
            'company_email' => '',
            'company_web' => '',
            'company_address' => '',
            'company_zipcode' => '',
            'company_person_contact' => '',
            'company_person_phone' => '',
            'company_person_email' => '',
        ];

    /**
     * Resets the form by clearing all form values and errors.
     */
    public function resetForm(): void
    {
        $this->reset();
        $this->resetErrorBag();
    }

    /**
     * Stores or updates a company object.
     *
     * @param  CompanyObj  $companyObj  The company object to be stored or updated.
     * @return array The message indicating the result of the operation.
     */
    public function companyStoreUpdate(CompanyObj $companyObj, CompanyValidation $companyValidation): array
    {

        if (! is_null($companyObj->show())) {
            return NotifyQuerys::msgUpdate(
                $companyObj->update(
                    $companyValidation->onCompanyUpdate($this->datacompany, $companyObj->getCompanyvalues()['id'])
                )
            );
        }

        return NotifyQuerys::msgCreate($companyObj->store($companyValidation->onCompanyCreate($this->datacompany)));
    }

    /**
     * Displays company information by processing the provided CompanyObj.
     *
     * Retrieves company data, and if available, sets the array values, province-city IDs,
     * and names for the company.
     *
     * @param  CompanyObj  $companyObj  The company object to be processed.
     */
    public function showCompany(CompanyObj $companyObj): void
    {
        $companyArray = $companyObj->show();

        if (! is_null($companyObj->show())) {

            $this->setArrayValues($companyArray->toArray());

            $this->setProvinceCity($companyArray->city->province->id, $companyArray->city->id);

            $this->setnameProvinceCity($companyArray->city->province->province_name->value(), $companyArray->city->city_name);
        }

    }

    /**
     * Sets the company data array.
     *
     * @param  array  $companyArray  The array containing company data to be set.
     */
    public function setArrayValues($companyArray): void
    {
        $this->datacompany = $companyArray;

    }
}
