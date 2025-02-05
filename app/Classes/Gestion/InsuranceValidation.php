<?php

namespace App\Classes\Gestion;

use Illuminate\Support\Facades\Validator;

class InsuranceValidation
{
    public function onInsuranceCreate(array $insurance)
    {

        return $validatedData = Validator::make(

            $this->inicialiciteAtributes($insurance),
            [
                'insurance_name' => config('validaterules.name_unique_reuired_min')(5, 'insurances', 'insurance_name'),
                'insurance_acronym' => config('validaterules.name_unique_reuired_min')(3, 'insurances', 'insurance_acronym'),
                'insurance_type_id' => 'gt:0|required',
                'province_id' => 'gt:0|required',
                'city_id' => 'gt:0|required',
                'state_id' => 'gt:0|required',
                'insurance_code' => config('validaterules.name_unique_reuired_min')(3, 'insurances', 'insurance_code'),
                'insurance_cuit' => config('validaterules.cuit_unique_required')('insurances', 'insurance_cuit', false, 5),
                'insurance_address' => config('validaterules.value_isrequired_min')(5, true),
                'insurance_phone' => config('validaterules.value_isrequired_min')(5, true),
                'insurance_zipcode' => config('validaterules.value_isrequired_min')(3, true),
                'insurance_email' => config('validaterules.email_isrequired')(true),
                'insurance_web' => config('validaterules.web_isrequired')(false),
            ],
            [
                'insurance_type_id.gt' => config('nicename.tipodeobragt'),
                'province_id.gt' => config('nicename.provinciagt'),
                'city_id.gt' => config('nicename.ciudadgt'),
                'state_id.gt' => config('nicename.estatus'),
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
            'insurance_zipcode' => config('nicename.zipcode'),
            'insurance_email' => config('nicename.correo'),
            'insurance_web' => config('nicename.web'),
        ];
    }
}
