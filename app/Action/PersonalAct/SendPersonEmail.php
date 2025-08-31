<?php

declare(strict_types=1);

namespace App\Action\PersonalAct;

use App\Classes\Services\EmailsModel;
use InvalidArgumentException;

final class SendPersonEmail
{
    public const ACTION_CREATE = 'created';

    public const ACTION_UPDATE = 'update';

    public function __construct(
        private readonly EmailsModel $emailsModel = new EmailsModel()
    ) {}

    public function handle($event, string $action, string $baseclass): void
    {
        match ($action) {
            self::ACTION_CREATE => $this->emailsModel->sendEmailCreate(
                new $baseclass($event->mailClass),
                $event->model, $event->receptor
            ),
            self::ACTION_UPDATE => $this->emailsModel->sendEmailUpdate(
                new $baseclass($event->mailClass),
                $event->model, $event->receptor
            ),
            default => throw new InvalidArgumentException("Invalid action: {$action}")
        };
    }
}
