<?php

declare(strict_types=1);

namespace App\Classes\Convenio;

use App\Classes\Utilities\AttributeValidator;
use Illuminate\Support\Facades\Validator;

final class PrestadorValidation
{
    public function validateServiceData(?int $excludeId, array $data): array
    {
        return Validator::make(
            $this->transformServiceData($data),
            $this->getValidationRules($excludeId),
            [
                'insurance_type_id.gt' => config('nicename.campo_obligado'),
                'state_id.gt' => config('nicename.campo_obligado'),
            ],
            $this->getValidationAttributes()
        )->validate();
    }

    private function transformServiceData($data): array
    {
        return [
            'insurance_name' => mb_strtoupper(mb_trim($data['insurance_name'])),
            'insurance_acronym' => mb_strtoupper(mb_trim($data['insurance_acronym'])),
            'insurance_type_id' => $data['insurance_type_id'],
            'province_id' => $data['province_id'],
            'city_id' => $data['city_id'],
            'state_id' => mb_trim((string) $data['state_id']),
            'insurance_code' => mb_strtoupper(mb_trim($data['insurance_code'])),
            'insurance_cuit' => mb_strtoupper(mb_trim($data['insurance_cuit'])),
            'insurance_address' => mb_trim($data['insurance_address']),
            'insurance_phone' => mb_trim($data['insurance_phone']),
            'insurance_zipcode' => mb_trim($data['insurance_zipcode']),
            'insurance_email' => mb_strtolower(mb_trim($data['insurance_email'])),
            'insurance_web' => mb_strtolower(mb_trim($data['insurance_web'])),
        ];
    }

    private function getValidationRules(?int $excludeId = null): array
    {
        return [
            'insurance_name' => AttributeValidator::uniqueIdNameLength(5, 'insurances', 'insurance_name', $excludeId),
            'insurance_acronym' => AttributeValidator::stringValidUnique('insurances', 'insurance_acronym', 3, $excludeId),
            'insurance_type_id' => 'gt:0|required',
            'province_id' => 'sometimes',
            'city_id' => 'sometimes',
            'state_id' => 'gt:0|required',
            'insurance_code' => AttributeValidator::stringValidUnique('insurances', 'insurance_code', 3, $excludeId),
            'insurance_cuit' => AttributeValidator::stringValidUnique('insurances', 'insurance_cuit', 5, $excludeId),
            'insurance_address' => AttributeValidator::stringValid(false, 5),
            'insurance_phone' => AttributeValidator::digitValid(5, false),
            'insurance_zipcode' => AttributeValidator::stringValid(false, 3),
            'insurance_email' => AttributeValidator::emailValid('insurances', 'insurance_email', $excludeId),
            'insurance_web' => AttributeValidator::webValid(false),
        ];
    }

    private function getValidationAttributes(): array
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
