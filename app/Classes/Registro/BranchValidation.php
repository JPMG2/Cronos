<?php

declare(strict_types=1);

namespace App\Classes\Registro;

use App\Classes\Utilities\AttributeValidator;
use Illuminate\Support\Facades\Validator;

final class BranchValidation
{
    public function onBranchCreate(array $branch)
    {

        return Validator::make(
            $this->inicialiciteAtributes($branch),
            [
                'company_id' => 'required',
                'province_id' => AttributeValidator::mayorValid(),
                'city_id' => AttributeValidator::mayorValid(),
                'state_id' => AttributeValidator::mayorValid(),
                'branch_name' => AttributeValidator::uniqueIdNameLength(3, 'branches', 'branch_name', null),
                'branch_code' => AttributeValidator::uniqueIdNameLength(3, 'branches', 'branch_code', null),
                'branch_address' => AttributeValidator::stringValid(true, 5),
                'branch_phone' => AttributeValidator::digitValid(5, true),
                'branch_zipcode' => AttributeValidator::stringValid(true, 3),
                'branch_email' => AttributeValidator::uniqueEmail('branches', 'branch_email', null),
                'branch_web' => AttributeValidator::webValid(false),
                'branch_person_contact' => AttributeValidator::stringValid(true, 5),
                'branch_person_phone' => AttributeValidator::digitValid(5, true),
                'branch_person_email' => AttributeValidator::uniqueEmail('branches', 'branch_person_email', null),
            ],
            [
                'province_id.gt' => config('nicename.campo_obligado'),
                'city_id.gt' => config('nicename.campo_obligado'),
                'state_id.gt' => config('nicename.campo_obligado'),
            ],
            $this->niceNames(),
        )->validate();
    }

    public function inicialiciteAtributes($branch)
    {

        return [
            'company_id' => mb_trim((string) $branch['company_id']),
            'state_id' => mb_trim((string) $branch['state_id']),
            'city_id' => mb_trim((string) $branch['city_id']),
            'province_id' => mb_trim((string) $branch['province_id']),
            'branch_name' => mb_strtoupper(mb_strtolower(mb_trim($branch['branch_name']))),
            'branch_code' => mb_trim($branch['branch_code']),
            'branch_address' => mb_trim($branch['branch_address']),
            'branch_phone' => mb_trim($branch['branch_phone']),
            'branch_zipcode' => mb_trim($branch['branch_zipcode']),
            'branch_email' => mb_strtolower(mb_trim($branch['branch_email'])),
            'branch_web' => mb_strtolower(mb_trim($branch['branch_web'])),
            'branch_person_contact' => mb_trim($branch['branch_person_contact']),
            'branch_person_phone' => mb_trim($branch['branch_person_phone']),
            'branch_person_email' => mb_strtolower(mb_trim($branch['branch_person_email'])),

        ];

    }

    public function niceNames(): array
    {
        return [
            'company_id' => config('nicename.company'),
            'branch_name' => config('nicename.sucursal'),
            'branch_code' => config('nicename.codigo'),
            'branch_address' => config('nicename.direccion'),
            'branch_phone' => config('nicename.telefono'),
            'branch_zipcode' => config('nicename.cp'),
            'branch_email' => config('nicename.correo'),
            'branch_web' => config('nicename.web'),
            'branch_person_contact' => config('nicename.contacto'),
            'branch_person_phone' => config('nicename.telefono'),
            'branch_person_email' => config('nicename.correo'),
            'state_id' => config('nicename.estatus'),
            'city_id' => 'ciudad',
            'province_id' => config('nicename.provincia'),
        ];
    }

    public function onBranchUpdate(array $branch)
    {

        return Validator::make(
            $this->inicialiciteAtributes($branch),
            [

                'company_id' => 'required',
                'province_id' => AttributeValidator::mayorValid(),
                'city_id' => AttributeValidator::mayorValid(),
                'state_id' => AttributeValidator::mayorValid(),
                'branch_name' => AttributeValidator::uniqueIdNameLength(3, 'branches', 'branch_name', $branch['id']),
                'branch_code' => AttributeValidator::uniqueIdNameLength(3, 'branches', 'branch_code', $branch['id']),
                'branch_address' => AttributeValidator::stringValid(true, 5),
                'branch_phone' => AttributeValidator::digitValid(5, true),
                'branch_zipcode' => AttributeValidator::stringValid(true, 3),
                'branch_email' => AttributeValidator::uniqueEmail('branches', 'branch_email', $branch['id']),
                'branch_web' => AttributeValidator::webValid(false),
                'branch_person_contact' => AttributeValidator::stringValid(true, 5),
                'branch_person_phone' => AttributeValidator::digitValid(5, true),
                'branch_person_email' => AttributeValidator::uniqueEmail('branches', 'branch_person_email', $branch['id']),
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
