<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\CredentialFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Credential extends Model
{
    /**
     * @use HasFactory<CredentialFactory>
     */
    use HasFactory;

    protected $fillable = [
        'credential_name',
        'credential_code',
    ];

    public static function credentialExist($idcredential, $credentialNumber, $credentialModelId = null): bool
    {
        if ($credentialModelId) {

            return self::where('id', $idcredential)
                ->whereHas(
                    'medicals',
                    function ($query) use ($credentialNumber, $credentialModelId) {
                        $query->where('credential_number', $credentialNumber)
                            ->whereNotIn('medicals.person_id', [$credentialModelId]);

                    }
                )->exists();
        }

        return self::whereHas(
            'medicals',
            static function ($query) use ($credentialNumber) {
                $query->where('credential_number', $credentialNumber);
            }
        )->where('id', $idcredential)->exists();
    }

    public function medicals()
    {
        return $this->belongsToMany(Medical::class)
            ->withPivot('credential_number');
    }

    protected function credentialName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords(mb_strtolower(mb_trim($value))),
        );
    }

    protected function credentialCode(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtoupper(mb_strtolower(mb_trim((string) $value))),
        );
    }
}
