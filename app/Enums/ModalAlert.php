<?php

declare(strict_types=1);

namespace App\Enums;

enum ModalAlert: string
{
    case ERROR = 'error';
    case WARNING = 'warning';
    case ACCEPT = 'accept';

    public function getName(): array
    {
        return match ($this) {
            self::ERROR => ['backgorund' => 'bg-red-100', 'textfield' => 'text-red-600', 'icon' => 'M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z'],
            self::WARNING => [],
            self::ACCEPT => [],

            default => [],
        };
    }
}
