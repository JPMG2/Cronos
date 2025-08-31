<?php

declare(strict_types=1);

namespace App\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class PersonType
{
    use Dispatchable,  SerializesModels;

    public string $personType;

    public Model $model;

    public string $action;

    public string $receptor;

    public function __construct($personType, $model, $action, $receptor, $mailClass)
    {
        $this->personType = $personType;
        $this->model = $model;
        $this->action = $action;
        $this->receptor = $receptor;
        $this->mailClass = $mailClass;
    }
}
