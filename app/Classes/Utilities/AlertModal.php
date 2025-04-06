<?php

declare(strict_types=1);

namespace App\Classes\Utilities;

final class AlertModal
{
    public function __construct(
        public int $exception,
        public string $type,
        public string $title,
        public string $buttonName,
        public string $event,
        public string $message,
        public int $idToDelete,

    ) {}
}
