<?php

namespace App\Traits;

use App\Models\Action;

trait HandlesActionPolicy
{
    public function getActionsProperty()
    {
        return new Action;
    }
}
