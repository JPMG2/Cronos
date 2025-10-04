<?php

declare(strict_types=1);

namespace App\Action;

use App\Classes\Services\EmailsModel;
use InvalidArgumentException;

final class SendEmail
{
    public const ACTION_CREATE = 'created';

    public const ACTION_UPDATE = 'update';

    public function __construct(
        private readonly EmailsModel $emailsModel = new EmailsModel()
    ) {}

    public function handle($model, string $action, string $baseClass, $mailClass, $receptor): void
    {
        match ($action) {
            self::ACTION_CREATE => $this->emailsModel->sendEmailCreate(
                new $baseClass($mailClass),
                $model,
                $receptor
            ),
            self::ACTION_UPDATE => $this->emailsModel->sendEmailUpdate(
                new $baseClass($mailClass),
                $model,
                $receptor
            ),
            default => throw new InvalidArgumentException("Invalid action: {$action}")
        };
    }
}
