<?php

namespace App\Classes\Utilities;

use App\Rules\MedicalCredential;

class AttributeValidator
{
    public static function uniqueIdNameLength($length, $model, $uniqueField, $id = null)
    {
        if ($id) {
            return 'required|unique:'.$model.','.$uniqueField.','.$id.'|min:'.$length.'|regex:/^([^<>]*)$/';
        }

        return 'required|unique:'.$model.','.$uniqueField.'|min:'.$length.'|regex:/^([^<>]*)$/';
    }

    public static function digitValid($length, $required)
    {
        if ($required) {
            return 'required|min:'.$length.'|regex:/^([0-9\s\-\+\(\)]*)$/';
        }

        return 'sometimes|min:'.$length.'|regex:/^([0-9\s\-\+\(\)]*)$/';
    }

    public static function uniqueEmail($model, $uniqueField, $id = null)
    {
        if ($id) {
            return 'required|unique:'.$model.','.$uniqueField.','.$id.'|email|regex:/^([^<>]*)$/';
        }

        return 'required|unique:'.$model.','.$uniqueField.'|email|regex:/^([^<>]*)$/';
    }

    public static function emailValid($required)
    {
        if ($required) {
            return 'required|email|regex:/^([^<>]*)$/';
        }

        return 'sometimes|email|regex:/^([^<>]*)$/';
    }

    public static function stringValid($required, $length)
    {
        if ($required) {
            return 'required|min:'.$length.'|regex:/^([^<>]*)$/';
        }

        return 'sometimes|min:'.$length.'|regex:/^([^<>]*)$/';
    }

    public static function webValid($required)
    {
        if ($required) {
            return 'required|url|regex:/^([^<>]*)$/';
        }

        return 'sometimes|url|regex:/^([^<>]*)$/';
    }

    public static function mayorValid()
    {
        return 'gt:0';
    }

    public static function medicalCredential(int $idcredential, $credential)
    {

        return new MedicalCredential($idcredential, $credential);
    }
}
