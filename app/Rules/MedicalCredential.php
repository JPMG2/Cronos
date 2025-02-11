<?php

namespace App\Rules;

use App\Models\Credential;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MedicalCredential implements ValidationRule
{
    protected $credentialID;

    protected $credentialNumber;

    protected $credentialModelId;

    public function __construct(int $credentialID, $credentialNumber, ?int $credentialModelId = null)
    {
        $this->credentialID = $credentialID;
        $this->credentialNumber = $credentialNumber;
        $this->credentialModelId = $credentialModelId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $credentialExist = Credential::credentialExist($this->credentialID, $this->credentialNumber, $this->credentialModelId);
        if ($credentialExist) {
            $fail('Matricula y Número. Ya existen');
        }
    }
}
