<?php

declare(strict_types=1);

namespace App\Traits;

trait ModelFunction
{
    public function objProperties(): array
    {
        return $this->getFillable();
    }
}
