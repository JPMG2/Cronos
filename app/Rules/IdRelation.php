<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Translation\PotentiallyTranslatedString;

final readonly class IdRelation implements ValidationRule
{
    public function __construct(
        private Model $model,
        private ?int $relationId = null,
        private ?int $id = null,
        private ?string $validColumn = null,
        private ?string $relation = null,
        private ?string $errorName = null
    ) {}

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if (is_null($this->relationId)) {
            $fail('El campo '.$this->relation.' es requerido');

            return;
        }

        if (is_null($this->validColumn) || is_null($this->relation)) {
            $fail('El campo con errores');

            return;
        }
        $query = $this->model->query()
            ->where($this->validColumn, $value)
            ->where($this->relation, $this->relationId);

        if ($this->id !== null) {
            $query->where('id', '!=', $this->id);
        }

        if ($query->exists()) {
            $fail('El campo '.$this->errorName.' ya existe');
        }
    }
}
