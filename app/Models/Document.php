<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\DocumentFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * /@property-read string $document_name
 */
final class Document extends Model
{
    /**
     * @use HasFactory<DocumentFactory>
     */
    use HasFactory;

    protected $fillable = ['document_name'];

    protected function documentName(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => ucfirst(mb_strtolower(mb_trim($value))),
        );
    }
}
