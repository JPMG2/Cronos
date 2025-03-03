<?php

namespace App\Livewire\Utility;

use Livewire\Attributes\On;
use Livewire\Component;

class AlertForm extends Component
{
    public $showAlert = false;

    public $title;

    public $type;

    public $message;

    public $button;

    public $buttonName;

    public $event;

    public function render()
    {
        return view('livewire.utility.alert-form');
    }

    #[On('showModalAlert')]
    public function showMessage(array $parametes)
    {

        $this->showAlert = $parametes['show'];
        $this->title = $parametes['title'];
        $this->type = $parametes['type'];
        $this->message = $parametes['message'];
        $this->button = $parametes['button'];
        $this->buttonName = $parametes['buttonName'];
        $this->event = $parametes['event'];
    }
}
