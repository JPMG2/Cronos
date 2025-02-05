<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Welcome extends Model
{
    use HasFactory;

    protected $fillable = ['activity'];

    public function logs(): MorphMany
    {
        return $this->morphMany(Log::class, 'model');
    }
}
