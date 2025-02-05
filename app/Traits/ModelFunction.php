<?php

namespace App\Traits;

trait ModelFunction
{
    public function objProperties(): array
    {
        return $this->getFillable();
    }
}