<?php

declare(strict_types=1);

namespace App\Rules;

use App\Models\Service;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

final class TypeGroupServices implements ValidationRule
{
    public function __construct(private readonly ?int $idService) {}

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->idService > 0) {
            $services = Service::query()->findOrFail($this->idService);
            if ($services->childrenCount > 0 and $value === 'final') {
                $fail('El tipo de servicio no puede ser final, tiene sub-servicios');
            }
        }
    }
}
