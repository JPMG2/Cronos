<?php

declare(strict_types=1);

namespace App\Livewire\Utility;

use Livewire\Attributes\On;
use Livewire\Component;

final class AlertForm extends Component
{
    public $showAlert = false;

    public $title;

    public $type;

    public $message;

    public $button;

    public $buttonName;

    public $event;

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.utility.alert-form');
    }

    #[On('showModalAlert')]
    public function showMessage(array $parameters): void
    {
        $this->showAlert = $parameters['show'];
        $this->title = $parameters['title'];
        $this->type = $parameters['type'];
        $this->message = $parameters['message'];
        $this->button = $parameters['button'];
        $this->buttonName = $parameters['buttonName'];
        $this->event = $parameters['event'];
    }

    public function closeModal(): void
    {
        $this->showAlert = false;
        $this->dispatch($this->event);
    }
}
