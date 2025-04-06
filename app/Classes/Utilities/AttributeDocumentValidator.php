<?php

declare(strict_types=1);

namespace App\Classes\Utilities;

use App\Rules\PersonDocumente;

final class AttributeDocumentValidator
{
    public static function documentTypeUnique(int $documentType, string $documentNum, $personId = null)
    {
        return new PersonDocumente($documentType, $documentNum, $personId);
    }
}
