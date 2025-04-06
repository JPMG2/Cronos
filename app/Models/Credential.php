<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\CredentialFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Credential extends Model
{
    /** @use HasFactory<CredentialFactory> */
    use HasFactory;

    protected $fillable = [
        'credential_name',
        'credential_code',
    ];

    public static function credentialExist($idcredential, $credentialnumbre, $credentialModelId = null): bool
    {
        if ($credentialModelId) {

            return self::whereHas('medicals', static function ($query) use ($credentialnumbre, $credentialModelId) {
                $query->where('credential_number', $credentialnumbre)
                    ->where('medical_id', '!=', $credentialModelId);
            })->where('id', $idcredential)->exists();
        }

        return self::whereHas('medicals', static function ($query) use ($credentialnumbre) {
            $query->where('credential_number', $credentialnumbre);
        })->where('id', $idcredential)->exists();
    }

    public function medicals()
    {
        return $this->belongsToMany(Medical::class)
            ->withPivot('credential_number');
    }

    protected function credentialName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(mb_strtolower(trim($value))),

        );
    }

    protected function credentialCode(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtoupper(mb_strtolower(trim($value))),

        );
    }
}
