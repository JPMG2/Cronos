<?php

declare(strict_types=1);

namespace App\Interfaces;

interface Filterable
{
    public static function getDefaultFilterField(): string;
}
