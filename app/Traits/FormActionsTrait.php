<?php

declare(strict_types=1);

namespace App\Traits;

use App\Http\Controllers\PDFController;

/**
 * Handles common form actions.
 *
 * @param  string  $action  The action to perform ('edit', 'new', 'print','show','history').
 * @param  array  $params  An associative array containing:
 *                         - 'Id'             => int
 *                         - 'pdfClass'       => string
 *                         - 'route'          => string
 *                         - 'model'          => string
 * @return void
 */
trait FormActionsTrait
{
    protected function handleAction($action, array $parameter)
    {
        $actions = [
            'edit' => fn() => $this->edit(),
            'new' => fn() => $this->new($parameter),
            'print' => fn() => $this->print($parameter),
            'show' => fn() => $this->show($parameter),
            'history' => fn() => $this->history($parameter),
        ];

        if (isset($actions[$action])) {
            $actions[$action]();
        }
    }

    protected function edit()
    {
        $this->editActivate();
    }

    protected function new(array $parameter)
    {
        to_route($parameter['route']);
    }

    protected function print(array $parameter)
    {
        $id = encryptString($parameter['id']);

        $class = $parameter['pdfClass'];

        $url = action([PDFController::class, 'pdfById'], ['id' => $id, 'class' => $class]);

        $this->dispatch('openWindow', ['url' => $url]);
    }

    protected function show(array $parameter)
    {
        $nameForm = $parameter['model'];

        $this->dispatch('showModal'.$nameForm, show: true);
    }

    protected function history(array $parameter)
    {
        $id = $parameter['id'];
        $model = $parameter['model'];
        $this->dispatch('showModalHistory', ['model' => $model, 'id' => $id]);
    }

    private function showMenuAction(): void
    {
        $this->dispatch('showOptionsForms', show: true);
        $this->isdisabled = 'disabled';
    }
}
