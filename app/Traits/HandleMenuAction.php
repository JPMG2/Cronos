<?php

declare(strict_types=1);

namespace App\Traits;

trait HandleMenuAction
{
    public $idRemove;

    public function messageWindow(mixed $model, ?callable $customValidation = null): void
    {
        if ($customValidation && is_callable($customValidation)) {
            $modalAttributes = $customValidation($model);
            $exception = $modalAttributes->exception;
            $tye = $modalAttributes->type;
            $title = $modalAttributes->title;
            $message = $modalAttributes->message;
            $buttonName = $modalAttributes->buttonName;
            $event = $modalAttributes->event;
            $this->idRemove = $modalAttributes->idModel;
            $this->triggerAlert($exception, $tye, $message, $title, $buttonName, $event);
        }
    }

    public function triggerAlert(
        int $exception,
        string $type,
        string $message,
        string $title,
        string $buttonName,
        string $event
    ): void {
        $this->dispatch(
            'showModalAlert',
            [
                'show' => 'true',
                'title' => $title,
                'type' => $type,
                'message' => $message,
                'button' => $exception,
                'buttonName' => $buttonName,
                'event' => $event,
            ]
        );
    }
}
