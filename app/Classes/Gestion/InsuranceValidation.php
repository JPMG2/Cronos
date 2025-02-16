<?php

namespace App\Classes\Gestion;

use App\Classes\Utilities\AttributeValidator;
use Illuminate\Support\Facades\Validator;

class InsuranceValidation
{
    public function onInsuranceCreate(array $insurance)
    {

        return Validator::make(

            $this->inicialiciteAtributes($insurance),
            [
                'insurance_name' => AttributeValidator::uniqueIdNameLength(5, 'insurances', 'insurance_name', null),
                'insurance_acronym' => AttributeValidator::stringValidUnique('insurances', 'insurance_acronym', 3, null),
                'insurance_type_id' => 'gt:0|required',
                'province_id' => 'gt:0|required',
                'city_id' => 'gt:0|required',
                'state_id' => 'gt:0|required',
                'insurance_code' => AttributeValidator::stringValidUnique('insurances', 'insurance_code', 3, null),
                'insurance_cuit' => AttributeValidator::stringValidUnique('insurances', 'insurance_cuit', 5, null),

                'insurance_address' => AttributeValidator::stringValid(false, 5),
                'insurance_phone' => AttributeValidator::digitValid(5, false),
                'insurance_zipcode' => AttributeValidator::stringValid(true, 3),
                'insurance_email' => AttributeValidator::emailValid(false),
                'insurance_web' => AttributeValidator::webValid(false),
            ],
            [
                'insurance_type_id.gt' => config('nicename.campo_obligado'),
                'province_id.gt' => config('nicename.campo_obligado'),
                'city_id.gt' => config('nicename.campo_obligado'),
                'state_id.gt' => config('nicename.campo_obligado'),
            ],
            $this->niceNames()

        )->validate();
    }

    public function inicialiciteAtributes($insurance)
    {

        return [

            'insurance_name' => strtoupper(trim($insurance['insurance_name'])),
            'insurance_acronym' => strtoupper(trim($insurance['insurance_acronym'])),
            'insurance_type_id' => trim($insurance['insurance_type_id']),
            'province_id' => trim($insurance['province_id']),
            'city_id' => trim($insurance['city_id']),
            'state_id' => trim($insurance['state_id']),
            'insurance_code' => strtoupper(trim($insurance['insurance_code'])),
            'insurance_cuit' => strtoupper(trim($insurance['insurance_cuit'])),
            'insurance_address' => trim($insurance['insurance_address']),
            'insurance_phone' => trim($insurance['insurance_phone']),
            'insurance_zipcode' => trim($insurance['insurance_zipcode']),
            'insurance_email' => strtolower(trim($insurance['insurance_email'])),
            'insurance_web' => strtolower(trim($insurance['insurance_web'])),
        ];

    }

    public function niceNames(): array
    {
        return [
            'insurance_name' => config('nicename.name'),
            'insurance_acronym' => config('nicename.siglas'),
            'insurance_type_id' => config('nicename.tipo'),
            'insurance_code' => config('nicename.codigo'),
            'insurance_cuit' => config('nicename.cuit'),
            'insurance_address' => config('nicename.direccion'),
            'insurance_phone' => config('nicename.telefono'),
            'insurance_zipcode' => config('nicename.cp'),
            'insurance_email' => config('nicename.correo'),
            'insurance_web' => config('nicename.web'),
        ];
    }
}
