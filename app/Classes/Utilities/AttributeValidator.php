<?php

declare(strict_types=1);

namespace App\Classes\Utilities;

use App\Rules\ArraySchedule;
use App\Rules\IdRelation;
use App\Rules\MedicalCredential;

/**
 * Utility class for building reusable Laravel validation rules.
 *
 * This class centralizes common validation patterns to maintain consistency
 * across the application and reduce code duplication.
 */
final class AttributeValidator
{
    /** @var int Maximum length for string fields */
    private const MAX_STRING_LENGTH = 255;

    /** @var string Regex pattern to prevent XSS attacks */
    private const XSS_PREVENTION_PATTERN = '/^([^<>]*)$/';

    /** @var string Regex pattern for digit validation (including phone formats) */
    private const DIGIT_PATTERN = '/^([0-9\s\-\+\(\)]*)$/';

    public static function uniqueIdNameLength($length, $model, $uniqueField, $id = null)
    {
        if ($id) {
            return ['required', 'unique:'.$model.','.$uniqueField.','.$id, 'min:'.$length, 'regex:'.self::XSS_PREVENTION_PATTERN, 'max:'.self::MAX_STRING_LENGTH];
        }

        return ['required', 'unique:'.$model.','.$uniqueField, 'min:'.$length, 'regex:'.self::XSS_PREVENTION_PATTERN, 'max:'.self::MAX_STRING_LENGTH];
    }

    public static function digitValid($length, $required)
    {
        if ($required) {
            return ['required', 'min:'.$length, 'regex:'.self::DIGIT_PATTERN, 'max:'.self::MAX_STRING_LENGTH];
        }

        return ['sometimes', 'min:'.$length, 'regex:'.self::DIGIT_PATTERN, 'max:'.self::MAX_STRING_LENGTH];
    }

    public static function uniqueEmail($model, $uniqueField, $id = null)
    {
        if ($id) {
            return ['required', 'email:rfc,dns', 'unique:'.$model.','.$uniqueField.','.$id, 'regex:'.self::XSS_PREVENTION_PATTERN, 'max:'.self::MAX_STRING_LENGTH];
        }

        return ['required', 'email:rfc,dns', 'unique:'.$model.','.$uniqueField, 'regex:'.self::XSS_PREVENTION_PATTERN, 'max:'.self::MAX_STRING_LENGTH];
    }

    public static function emailValid($model, $uniqueField, $id = null)
    {
        return $id ?
            ['sometimes', 'unique:'.$model.','.$uniqueField.','.$id, 'email:rfc', 'regex:'.self::XSS_PREVENTION_PATTERN, 'max:'.self::MAX_STRING_LENGTH] :
           ['sometimes', 'unique:'.$model.','.$uniqueField, 'email:rfc', 'regex:'.self::XSS_PREVENTION_PATTERN, 'max:'.self::MAX_STRING_LENGTH];
    }

    public static function emailValidById($id, $model, $uniqueField)
    {
        return ['sometimes', 'email:rfc,dns', 'unique:'.$model.','.$uniqueField.','.$id, 'regex:'.self::XSS_PREVENTION_PATTERN, 'max:'.self::MAX_STRING_LENGTH];
    }

    public static function stringValid($required, $length)
    {
        return $required ?
            ['required', 'min:'.$length, 'regex:'.self::XSS_PREVENTION_PATTERN, 'max:'.self::MAX_STRING_LENGTH] :
            ['sometimes', 'min:'.$length, 'regex:'.self::XSS_PREVENTION_PATTERN, 'max:'.self::MAX_STRING_LENGTH];

    }

    public static function stringValidUnique($model, $uniqueField, $length, $id = null)
    {
        return $id ?
            ['sometimes', 'min:'.$length, 'unique:'.$model.','.$uniqueField.','.$id, 'regex:'.self::XSS_PREVENTION_PATTERN, 'max:'.self::MAX_STRING_LENGTH] :
            ['sometimes', 'min:'.$length, 'unique:'.$model.','.$uniqueField, 'regex:'.self::XSS_PREVENTION_PATTERN, 'max:'.self::MAX_STRING_LENGTH];
    }

    public static function webValid($required)
    {
        return $required
            ? ['required', 'url',  'active_url', 'regex:'.self::XSS_PREVENTION_PATTERN, 'max:'.self::MAX_STRING_LENGTH]
            : ['sometimes', 'url', 'active_url', 'regex:'.self::XSS_PREVENTION_PATTERN, 'max:'.self::MAX_STRING_LENGTH];

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
            ? ['required', 'date_format:d-m-Y', 'max:'.self::MAX_STRING_LENGTH, 'regex:'.self::XSS_PREVENTION_PATTERN] :
              ['sometimes', 'date_format:d-m-Y', 'max:'.self::MAX_STRING_LENGTH, 'regex:'.self::XSS_PREVENTION_PATTERN];
    }

    public static function hasTobeArray($length)
    {
        return 'array|min:'.$length;
    }

    public static function scheduleArray(array $schedule): ArraySchedule
    {
        return new ArraySchedule($schedule);
    }

    public static function idRelationUnique($model, ?int $relationId, ?int $id, $columnValidation, $relationColumn, $errorName = null)
    {
        return [
            'bail',
            'required',
            'max:'.self::MAX_STRING_LENGTH,
            'regex:'.self::XSS_PREVENTION_PATTERN,
            new IdRelation(
                model: $model,
                relationId: $relationId,
                id: $id,
                validColumn: $columnValidation,
                relation: $relationColumn,
                errorName: $errorName
            ),
        ];
    }

    public static function requireAndExists($model, $uniqueField, $column, $require = null): array
    {
        return $require ? ['required',  'integer', 'exists:'.$model.','.$uniqueField]
            : ['nullable', 'exclude_if:'.$column.',0', 'integer'];

    }

    public static function booleanValue($required)
    {
        return $required ? ['required', 'boolean'] : ['sometimes', 'boolean'];

    }

    public static function dateAfther($required, $date)
    {
        return $required ? ['required', 'date_format:d-m-Y', 'after:'.$date] :
            ['sometimes', 'date_format:d-m-Y', 'after:'.$date];
    }
}
