<?php

declare(strict_types=1);

namespace App\Observers;

use App\Action\SendEmail;
use App\Classes\Registro\BranchEmail;
use App\Classes\Registro\CompanyEmail;
use App\Mail\Registro\BranchCreateMail;
use App\Mail\Registro\BranchUpdateMail;
use App\Mail\Registro\CompanyCreateMail;
use App\Mail\Registro\CompanyUpdateMail;
use App\Models\Branch;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

final class EmailModelObserver
{
    public function __construct(
        private readonly SendEmail $sendEmail
    ) {}

    public function created(Model $model): void
    {
        $emailClasses = $this->getEmailClasses($model);

        $this->sendEmail->handle(
            $model,
            SendEmail::ACTION_CREATE,
            $emailClasses['baseClass'],
            $emailClasses['createMailClass']
        );
    }

    public function updated(Model $model): void
    {
        if ($model->isDirty($model->checkchange)) {
            $emailClasses = $this->getEmailClasses($model);

            $this->sendEmail->handle(
                $model,
                SendEmail::ACTION_UPDATE,
                $emailClasses['baseClass'],
                $emailClasses['updateMailClass']
            );
        }
    }

    /**
     * Get the appropriate email classes based on model type
     */
    private function getEmailClasses(Model $model): array
    {
        return match (true) {
            $model instanceof Branch => [
                'baseClass' => BranchEmail::class,
                'createMailClass' => BranchCreateMail::class,
                'updateMailClass' => BranchUpdateMail::class,
            ],
            $model instanceof Company => [
                'baseClass' => CompanyEmail::class,
                'createMailClass' => CompanyCreateMail::class,
                'updateMailClass' => CompanyUpdateMail::class,
            ],
            default => throw new InvalidArgumentException('Unsupported model type for email notification'),
        };
    }
}
