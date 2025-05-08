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
            return 'required|unique:'.$model.','.$uniqueField.','.$id.'|email|regex:/^([^<>]*)$/|max:255';
        }

        return 'required|unique:'.$model.','.$uniqueField.'|email|regex:/^([^<>]*)$/|max:255';
    }

    public static function emailValid($model, $uniqueField, $id = null)
    {
        if ($id) {
            return 'sometimes|unique:'.$model.','.$uniqueField.','.$id.'|email|regex:/^([^<>]*)$/|max:255';
        }

        return 'sometimes|unique:'.$model.','.$uniqueField.'|email|regex:/^([^<>]*)$/|max:255';
    }

    public static function emailValidById($id, $model, $uniqueField)
    {
        return 'sometimes|unique:'.$model.','.$uniqueField.','.$id.'|email|regex:/^([^<>]*)$/|max:255';
    }

    public static function stringValid($required, $length)
    {
        if ($required) {
            return 'required|min:'.$length.'|regex:/^([^<>]*)$/|max:255';
        }

        return 'sometimes|min:'.$length.'|regex:/^([^<>]*)$/|max:255';
    }

    public static function stringValidUnique($model, $uniqueField, $length, $id = null)
    {
        if ($id) {
            return 'sometimes|min:'.$length.'|unique:'.$model.','.$uniqueField.','.$id.'|regex:/^([^<>]*)$/|max:255';
        }

        return 'sometimes|min:'.$length.'|unique:'.$model.','.$uniqueField.'|regex:/^([^<>]*)$/|max:255';
    }

    public static function webValid($required)
    {
        if ($required) {
            return 'required|url|regex:/^([^<>]*)$/|max:255';
        }

        return 'sometimes|url|regex:/^([^<>]*)$/|max:255';
    }

    public static function mayorValid()
    {
        return 'gt:0';
    }

    public static function medicalCredential(int $idcredential, $credential, $id = null)
    {

        return new MedicalCredential($idcredential, $credential, $id);
    }

    public static function dateValid($required)
    {
        if ($required) {
            return 'required|regex:/^([^<>]*)$/|max:255|date_format:d-m-Y';
        }

        return 'sometimes|regex:/^([^<>]*)$/|max:255|date_format:d-m-Y';
    }

    public static function hasTobeArray($length)
    {
        return 'array|min:'.$length;
    }

    public static function scheduleArray(array $schedule)
    {
        return new ArraySchedule($schedule);
    }
}
