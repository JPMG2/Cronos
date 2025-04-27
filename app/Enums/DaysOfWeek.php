<?php

declare(strict_types=1);

namespace App\Enums;

enum DaysOfWeek: int
{
    case Domingo = 0;
    case Lunes = 1;
    case Martes = 2;
    case Miercoles = 3;
    case Jueves = 4;
    case Viernes = 5;
    case Sabado = 6;

    public function getName(): string
    {
        return match ($this) {
            self::Domingo => 'Domingo',
            self::Lunes => 'Lunes',
            self::Martes => 'Martes',
            self::Miercoles => 'Miércoles',
            self::Jueves => 'Jueves',
            self::Viernes => 'Viernes',
            self::Sabado => 'Sábado',
        };
    }
}
