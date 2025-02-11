<?php

namespace App\Livewire\Utility;

use App\Http\Controllers\PDFController;
use Livewire\Attributes\On;
use Livewire\Component;

class OptionMenuForm extends Component
{
    #[On('showOptionForm')]
    public function onShow($eventname, $atribute)
    {
        $this->dispatch($eventname, show: $atribute);
    }

    #[On('new-form')]
    public function newRedirect($routename)
    {
        $this->redirect($routename);
    }

    #[On('printByID')]
    public function printIdModel($arayvalues)
    {
        $id = encryptString($arayvalues['idmodel']);

        $class = $arayvalues['className'];

        $url = action([PDFController::class, 'pdfById'], ['id' => $id, 'class' => $class]);

        $this->dispatch('openWindow', ['url' => $url]);
    }

    public function render()
    {
        return <<<'HTML'
        <div>
        </div>
        HTML;
    }
}
