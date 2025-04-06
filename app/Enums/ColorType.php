<?php

declare(strict_types=1);

namespace App\Enums;

enum ColorType: string
{
    case ERROR = 'error';
    case SUCCESS = 'success';

    case WARNING = 'warning';
    case TXTIMPORTANTE = 'txtimportant';
    case TXTWARNING = 'txtwarning';
    case TXTDANGER = 'txtdanger';
    case TXTSUCCESS = 'txtsucces';
    case TXTNORMAL = 'txtnormal';
    case TXTSELECTED = 'txtselected';

    public function getName(): string
    {
        return match ($this) {
            self::ERROR => 'bg-red-500',
            self::SUCCESS => 'bg-green-500',
            self::WARNING => 'bg-yellow-500',
            self::TXTIMPORTANTE => 'text-gray-700',
            self::TXTWARNING => 'text-yellow-500',
            self::TXTDANGER => 'text-red-500',
            self::TXTSUCCESS => 'text-green-500',
            self::TXTNORMAL => 'text-gray-500',
            self::TXTSELECTED => 'text-blue-500',
            default => '',
        };
    }
}
