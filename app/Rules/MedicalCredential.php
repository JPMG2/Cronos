<?php

declare(strict_types=1);

namespace App\Rules;

use App\Models\Credential;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class MedicalCredential implements ValidationRule
{
    public function __construct(private readonly int $credentialID, private $credentialNumber, private readonly ?int $credentialModelId = null) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $credentialExist = Credential::credentialExist($this->credentialID, $this->credentialNumber, $this->credentialModelId);
        if ($credentialExist) {
            $fail('matricula y número. Ya existen');
        }
    }
}
