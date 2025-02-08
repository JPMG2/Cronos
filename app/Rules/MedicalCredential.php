<?php

namespace App\Rules;

use App\Models\Credential;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MedicalCredential implements ValidationRule
{
    protected $credentialID;

    protected $credentialNumber;

    public function __construct(int $credentialID, $credentialNumber)
    {
        $this->credentialID = $credentialID;
        $this->credentialNumber = $credentialNumber;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $credentialExist = Credential::credentialExist($this->credentialID, $this->credentialNumber);
        if ($credentialExist) {
            $fail('Matricula y Número. Ya existen');
        }
    }
}
