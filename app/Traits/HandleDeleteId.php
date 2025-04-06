<?php

declare(strict_types=1);

namespace App\Traits;

trait HandleDeleteId
{
    public $idRemove;

    public function deleteModel(mixed $model, ?callable $customValidation = null)
    {
        if ($customValidation && is_callable($customValidation)) {
            $modalAttributes = $customValidation($model);
            $exception = $modalAttributes->exception;
            $tye = $modalAttributes->type;
            $title = $modalAttributes->title;
            $message = $modalAttributes->message;
            $buttonName = $modalAttributes->buttonName;
            $event = $modalAttributes->event;
            $this->idRemove = $modalAttributes->idToDelete;
            $this->triggerAlert($exception, $tye, $message, $title, $buttonName, $event);
        }
    }

    public function triggerAlert(int $exception, string $type, string $message, string $title,
        string $buttonName, string $event)
    {
        $this->dispatch('showModalAlert', [
            'show' => 'true',
            'title' => $title,
            'type' => $type,
            'message' => $message,
            'button' => $exception,
            'buttonName' => $buttonName,
            'event' => $event,
        ]);
    }
}
