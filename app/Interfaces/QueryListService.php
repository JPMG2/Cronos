<?php

declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

interface QueryListService
{
    public function listSearch(array $filterConditions): EloquentBuilder;
}
