<?php

namespace App\Classes\Registro;

use App\Models\Company;
use App\Traits\UtilityForm;

class CompanyObj
{
    use UtilityForm;

    public array $companyvalues;

    protected $modelName = 'Company';

    /**
     * Get the company values.
     *
     * @return array The company values.
     */
    public function getCompanyvalues(): array
    {
        return $this->companyvalues;
    }

    /**
     * Set the company values.
     */
    public function setCompanyvalues(array $companyvalues): void
    {
        $this->companyvalues = $companyvalues;
    }

    /**
     * Store a new company.
     *
     * @param  array  $arrayCompany  The array containing the company data.
     * @return Company The newly created ReCompany instance.
     */
    public function store(array $arrayCompany): Company
    {

        return Company::create($this->getValuesModel($arrayCompany, $this->modelName));
    }

    /**
     * Update a record in the database
     *
     * @param  array  $arrayCompany  The array of values to update the record with
     * @return Company The updated Company model
     */
    public function update(array $arrayCompany): Company
    {
        return tap($this->show())->update($this->getValuesModel($arrayCompany, $this->modelName));

    }

    /**
     * Retrieve and return the first company with its associated city and province.
     * If no company is found, return NULL.
     *
     * @return Company|null The first company instance with its associated city and province, or NULL if no company is found.
     */
    public function show(): ?Company
    {
        $company = Company::with('city.province')->first();

        if (! is_null($company)) {
            $this->setCompanyvalues($company->toArray());
        }

        return $company;
    }

    /**
     * Check if a company record exists.
     *
     * This method checks if there is at least one company record in the database.
     *
     * @return bool True if a company record exists, false otherwise.
     */
    public function companyExist(): bool
    {
        return ! is_null(Company::first());
    }
}
