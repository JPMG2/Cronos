<?php

declare(strict_types=1);

namespace App\Enums;

enum ServiceType: string
{
    case FINAL = 'final';
    case GROUP = 'group';

    public static function options(): array
    {
        return array_map(
            fn (self $type) => [
                'value' => $type->value,
                'label' => $type->label(),
            ],
            self::cases()
        );
    }

    public function label(): string
    {
        return match ($this) {
            self::FINAL => 'Final',
            self::GROUP => 'Grupo',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::FINAL => 'NO permite servicios hijos',
            self::GROUP => 'Permite servicios hijos',
        };
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::FINAL => 'blue',
            self::GROUP => 'green',
        };
    }
}
