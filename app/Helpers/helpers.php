<?php

declare(strict_types=1);

/* explode Breadcrumbs to use in Form */

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;

function exploBreadcrum($breadcrum)
{

    return explode('/', (string) $breadcrum);
}

/* return a string from an array */
function arrayString(array $arraKeys): string
{
    [$keys] = Arr::divide($arraKeys);
    $keysString = '';
    $delimiter = ',';
    $counter = count($keys);

    for ($i = 0; $i < $counter; $i++) {
        if ($i === array_key_last($keys)) {
            $delimiter = '';
        }

        $keysString .= "'" . $keys[$i] . "'" . $delimiter;
    }

    return $keysString;
}

/* return only necessary keys of and array */
function prepareData($arrayTemp, $arrayOriginal): array
{
    return Arr::only($arrayTemp, $arrayOriginal);
}

/* return a string in format Title */

function stringToTitle(string $stringValue): string
{
    return str(str($stringValue)->lower())->title()->toString();
}

function iconName(string $icon): array
{
    return [
        'document' => 'M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25',
        'planes' => 'M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122',
        'calcular' => 'M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V13.5Zm0 2.25h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V18Zm2.498-6.75h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V13.5Zm0 2.25h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V18Zm2.504-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5Zm0 2.25h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V18Zm2.498-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5ZM8.25 6h7.5v2.25h-7.5V6ZM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 0 0 2.25 2.25h10.5a2.25 2.25 0 0 0 2.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0 0 12 2.25Z',
        'exit' => 'M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1',
    ];
}

function encryptString(int $value): string
{
    return Crypt::encryptString($value);
}

function decryptString($value): false|string
{
    return Crypt::decryptString($value);
}

function searchKeyArray(array $array, string $keyName): ?string
{
    return array_find_key($array, fn ($value) => str_contains((string) $value, $keyName));

}

function copyKeysArray(array $arrayData, array $arrayKeys): array
{
    return array_intersect_key($arrayData, $arrayKeys);
}

function arrayMerge(array $array1, array $array2): array
{
    return array_merge($array1, $array2);
}

function castToFloat(mixed $value): ?float
{
    if ($value === null || $value === '') {
        return null;
    }

    if (is_float($value)) {
        return $value;
    }

    if (is_numeric($value)) {
        return (float) $value;
    }

    $cleaned = str_replace(',', '', (string) $value);

    return is_numeric($cleaned) ? (float) $cleaned : null;
}

function castToInt(mixed $value): ?int
{
    if ($value === null || $value === '') {
        return null;
    }

    if (is_int($value)) {
        return $value;
    }

    if (is_numeric($value)) {
        return (int) $value;
    }

    $cleaned = str_replace(',', '', (string) $value);

    return is_numeric($cleaned) ? (int) $cleaned : null;
}

function moneyToCents(mixed $value): ?int
{
    if ($value === null || $value === '') {
        return null;
    }

    if ($value instanceof Money\Money) {
        return (int) $value->getAmount();
    }

    $cleaned = str_replace(',', '', (string) $value);

    if (is_numeric($cleaned)) {
        $amount = (float) $cleaned * 100;

        return (int) round($amount);
    }

    return null;
}

function centsToMoney(?int $cents): ?Money\Money
{
    if ($cents === null) {
        return null;
    }

    $currency = config('app.currency', 'ARS');

    return new Money\Money((string) $cents, new Money\Currency($currency));
}

function formatMoney(?Money\Money $money): string
{
    if ($money === null) {
        return '';
    }

    $formatter = new Money\Formatter\IntlMoneyFormatter(
        new NumberFormatter('es_AR', NumberFormatter::CURRENCY),
        new Money\Currencies\ISOCurrencies(),
    );

    return $formatter->format($money);
}

function moneyToFloat(?Money\Money $money): ?float
{
    if ($money === null) {
        return null;
    }

    return (float) $money->getAmount() / 100;
}

function moneyToInput(?Money\Money $money): ?string
{
    if ($money === null) {
        return null;
    }

    $float = (float) $money->getAmount() / 100;

    return number_format($float, 2, '.', ',');
}
