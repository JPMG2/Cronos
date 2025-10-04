<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Translation\PotentiallyTranslatedString;

final class IdRelation implements ValidationRule
{
    private Model $model;

    private ?int $relationId;

    private ?int $id;

    private ?string $relation;

    private ?string $validColumn;

    private ?string $errorName;

    public function __construct(
        Model $model,
        ?int $relationId = null,
        ?int $id = null,
        ?string $validColumn = null,
        ?string $relation = null,
        ?string $errorName = null
    ) {
        $this->model = $model;
        $this->relationId = $relationId;
        $this->id = $id;
        $this->relation = $relation;
        $this->validColumn = $validColumn;
        $this->errorName = $errorName;
    }

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
        if (is_null($this->id)) {
            $exist = $this->model->query()->where($this->validColumn, $value)
                ->where($this->relation, $this->relationId)
                ->exists();
            if ($exist) {
                $fail('El campo '.$this->errorName.' ya existe');

            }
        }

    }
}
