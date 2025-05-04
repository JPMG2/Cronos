<?php

declare(strict_types=1);

namespace App\Action;

use App\Classes\Services\EmailsModel;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

final class SendEmail
{
    public const ACTION_CREATE = 'created';

    public const ACTION_UPDATE = 'update';

    public function __construct(
        private readonly EmailsModel $emailsModel = new EmailsModel()
    ) {}

    public function handle(Model $model, string $action, string $baseclass, string $emailclass): void
    {
        match ($action) {
            self::ACTION_CREATE => $this->emailsModel->sendEmailCreate(
                new $baseclass($emailclass),
                $model
            ),
            self::ACTION_UPDATE => $this->emailsModel->sendEmailUpdate(
                new $baseclass($emailclass),
                $model
            ),
            default => throw new InvalidArgumentException("Invalid action: {$action}")
        };
    }
}
