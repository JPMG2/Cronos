<?php

declare(strict_types=1);

namespace App\Rules;

use App\Models\Person;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

final class PersonDocumente implements ValidationRule
{
    private $idTypeDocument;

    private $numDocument;

    private $idPerson;

    public function __construct($idTypeDocument, $numDocument, $idPerson)
    {
        $this->idTypeDocument = $idTypeDocument;
        $this->numDocument = $numDocument;
        $this->idPerson = $idPerson;
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $documentExist = Person::documentExist($this->idTypeDocument, $this->numDocument, $this->idPerson);
        if ($documentExist) {
            $fail('El documento ya existe');
        }
    }
}
