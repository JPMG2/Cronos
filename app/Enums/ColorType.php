<?php

namespace App\Enums;

enum ColorType: string
{
    case ERROR = 'error';
    case SUCCESS = 'success';

    case WARNING = 'warning';

    public function getName(): string
    {
        return match ($this) {
            self::ERROR => 'bg-red-500',
            self::SUCCESS => 'bg-green-500',
            self::WARNING => 'bg-yellow-500',
            default => '',
        };
    }
}
