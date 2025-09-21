<?php

declare(strict_types=1);

namespace App\Classes\Utilities;

use App\Rules\ArraySchedule;
use App\Rules\MedicalCredential;

final class AttributeValidator
{
    public static function uniqueIdNameLength($length, $model, $uniqueField, $id = null)
    {
        if ($id) {
            return 'required|unique:'.$model.','.$uniqueField.','.$id.'|min:'.$length.'|regex:/^([^<>]*)$/|max:255';
        }

        return 'required|unique:'.$model.','.$uniqueField.'|min:'.$length.'|regex:/^([^<>]*)$/|max:255';
    }

    public static function digitValid($length, $required)
    {
        if ($required) {
            return 'required|min:'.$length.'|regex:/^([0-9\s\-\+\(\)]*)$/|max:255';
        }

        return 'sometimes|min:'.$length.'|regex:/^([0-9\s\-\+\(\)]*)$/|max:255';
    }

    public static function uniqueEmail($model, $uniqueField, $id = null)
    {
        if ($id) {
            return 'required|unique:'.$model.','.$uniqueField.','.$id.'|email:rfc,dns|regex:/^([^<>]*)$/|max:255';
        }

        return 'required|unique:'.$model.','.$uniqueField.'|email:rfc,dns|regex:/^([^<>]*)$/|max:255';
    }

    public static function emailValid($model, $uniqueField, $id = null)
    {
        return $id ?
            ['sometimes', 'unique:'.$model.','.$uniqueField.','.$id, 'email:rfc,dns', 'regex:/^([^<>]*)$/', 'max:255'] :
           ['sometimes', 'unique:'.$model.','.$uniqueField, 'email:rfc,dns', 'regex:/^([^<>]*)$/', 'max:255'];
    }

    public static function emailValidById($id, $model, $uniqueField)
    {
        return ['sometimes', 'email:rfc,dns', 'unique:'.$model.','.$uniqueField.','.$id, 'regex:/^([^<>]*)$/', 'max:255'];
    }

    public static function stringValid($required, $length)
    {
        return $required ?
            ['required', 'min:'.$length, 'regex:/^([^<>]*)$/', 'max:255'] :
            ['sometimes', 'min:'.$length, 'regex:/^([^<>]*)$/', 'max:255'];

    }

    public static function stringValidUnique($model, $uniqueField, $length, $id = null)
    {
        return $id ?
            ['sometimes', 'min:'.$length, 'unique:'.$model.','.$uniqueField.','.$id, 'regex:/^([^<>]*)$/', 'max:255'] :
            ['sometimes', 'min:'.$length, 'unique:'.$model.','.$uniqueField, 'regex:/^([^<>]*)$/', 'max:255'];
    }

    public static function webValid($required)
    {
        return $required
            ? ['required', 'url',  'active_url', 'regex:/^([^<>]*)$/', 'max:255']
            : ['sometimes', 'url', 'active_url', 'regex:/^([^<>]*)$/', 'max:255'];

    }

    public static function mayorValid()
    {
        return 'gt:0';
    }

    public static function medicalCredential(int $idcredential, $credentialNumber, $id = null)
    {

        return new MedicalCredential($idcredential, $credentialNumber, $id);
    }

    public static function dateValid($required)
    {
        return $required
            ? ['required', 'date_format:d-m-Y', 'max:255', 'regex:/^([^<>]*)$/'] :
              ['sometimes', 'date_format:d-m-Y', 'max:255', 'regex:/^([^<>]*)$/'];
    }

    public static function hasTobeArray($length)
    {
        return 'array|min:'.$length;
    }

    public static function scheduleArray(array $schedule): ArraySchedule
    {
        return new ArraySchedule($schedule);
    }

    public static function requireAndExists($model, $uniqueField, $column, $require = null): array
    {
        return $require ? ['required',  'integer', 'exists:'.$model.','.$uniqueField]
            : ['nullable', 'exclude_if:'.$column.',0', 'integer'];

    }
}
