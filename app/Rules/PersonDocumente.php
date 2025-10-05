<?php

declare(strict_types=1);

namespace App\Rules;

use App\Models\Person;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

final class PersonDocumente implements ValidationRule
{
    public function __construct(private readonly int $idTypeDocument, $numDocument, private readonly ?int $idPerson) {}

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $_attribute, mixed $value, Closure $fail): void
    {
        $documentExist = Person::documentExist($this->idTypeDocument, $value, $this->idPerson);
        if ($documentExist) {
            $fail('El documento ya existe');
        }
    }
}
