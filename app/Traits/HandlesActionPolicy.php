<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Action;

trait HandlesActionPolicy
{
    public function getActionsProperty(): Action
    {
        return new Action();
    }
}
