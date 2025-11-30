<?php

declare(strict_types=1);

namespace App\Classes\Registro;

use App\Classes\Utilities\AttributeValidator;
use Illuminate\Support\Facades\Validator;

final class CompanyValidation
{
    public function onCompanyCreate(array $company)
    {

        return Validator::make(
            $this->inicialiciteAtributes($company),
            [

                'company_name' => AttributeValidator::uniqueIdNameLength(3, 'companies', 'company_name', null),
                'company_cuit' => AttributeValidator::uniqueIdNameLength(5, 'companies', 'company_cuit', null),
                'company_phone' => AttributeValidator::digitValid(5, true),
                'company_email' => AttributeValidator::uniqueEmail('companies', 'company_email', null),
                'company_address' => AttributeValidator::stringValid(true, 5),
                'company_zipcode' => AttributeValidator::stringValid(true, 3),
                'company_person_contact' => AttributeValidator::stringValid(true, 5),
                'company_person_phone' => AttributeValidator::digitValid(5, true),
                'company_web' => AttributeValidator::webValid(false),
                'company_person_email' => AttributeValidator::uniqueEmail('companies', 'company_person_email', null),
                'province_id' => AttributeValidator::mayorValid(),
                'city_id' => AttributeValidator::mayorValid(),
                'state_id' => AttributeValidator::mayorValid(),

            ],
            [
                'province_id.gt' => config('nicename.campo_obligado'),
                'city_id.gt' => config('nicename.campo_obligado'),
                'state_id.gt' => config('nicename.campo_obligado'),
            ],
            $this->niceNames(),
        )->validate();
    }

    public function inicialiciteAtributes($company)
    {

        return [
            'company_name' => mb_strtoupper(mb_strtolower(mb_trim($company['company_name']))),
            'company_cuit' => mb_trim($company['company_cuit']),
            'company_phone' => mb_trim($company['company_phone']),
            'company_email' => mb_strtolower(mb_trim($company['company_email'])),
            'company_address' => mb_trim($company['company_address']),
            'company_zipcode' => mb_trim($company['company_zipcode']),
            'company_person_contact' => mb_trim($company['company_person_contact']),
            'company_person_phone' => mb_trim($company['company_person_phone']),
            'company_person_email' => mb_strtolower(mb_trim($company['company_person_email'])),
            'company_web' => mb_strtolower(mb_trim($company['company_web'])),
            'province_id' => mb_trim((string) $company['province_id']),
            'city_id' => mb_trim((string) $company['city_id']),
            'state_id' => mb_trim((string) $company['state_id']),
        ];

    }

    public function niceNames(): array
    {
        return [
            'city_id' => 'ciudad',
            'company_name' => config('nicename.company'),
            'company_cuit' => config('nicename.cuit'),
            'company_phone' => config('nicename.telefono'),
            'company_email' => config('nicename.correo'),
            'company_address' => config('nicename.direccion'),
            'company_zipcode' => config('nicename.cp'),
            'company_person_contact' => config('nicename.contacto'),
            'company_person_phone' => config('nicename.telefono'),
            'company_person_email' => config('nicename.correo'),
            'province_id' => config('nicename.provincia'),
            'company_web' => config('nicename.web'),
        ];
    }

    public function onCompanyUpdate(array $company, $idcompany)
    {
        return Validator::make(
            $this->inicialiciteAtributes($company),
            [
                'company_name' => AttributeValidator::uniqueIdNameLength(3, 'companies', 'company_name', $idcompany),
                'company_cuit' => AttributeValidator::uniqueIdNameLength(5, 'companies', 'company_cuit', $idcompany),
                'company_phone' => AttributeValidator::digitValid(5, true),
                'company_email' => AttributeValidator::uniqueEmail('companies', 'company_email', $idcompany),
                'company_address' => AttributeValidator::stringValid(true, 5),
                'company_zipcode' => AttributeValidator::stringValid(true, 3),
                'company_person_contact' => AttributeValidator::stringValid(true, 5),
                'company_person_phone' => AttributeValidator::digitValid(5, true),
                'company_web' => AttributeValidator::webValid(false),
                'company_person_email' => AttributeValidator::uniqueEmail('companies', 'company_person_email', $idcompany),
                'province_id' => AttributeValidator::mayorValid(),
                'city_id' => AttributeValidator::mayorValid(),
                'state_id' => AttributeValidator::mayorValid(),
            ],
            [
                'province_id.gt' => config('nicename.campo_obligado'),
                'city_id.gt' => config('nicename.campo_obligado'),
                'state_id.gt' => config('nicename.campo_obligado'),
            ],
            $this->niceNames(),
        )->validate();
    }
}
