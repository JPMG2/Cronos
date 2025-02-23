<?php

namespace App\Traits;

use App\Http\Controllers\PDFController;

/**
 * Handles common form actions.
 *
 * @param  string  $action  The action to perform ('edit', 'new', 'print','show','history').
 * @param  array  $params  An associative array containing:
 *                         - 'id'             => int
 *                         - 'pdfClass'       => string
 *                         - 'route'          => string
 *                         - 'model'          => string
 * @return void
 */
trait FormActionsTrait
{
    protected function handleAction($action, array $parameter)
    {
        switch ($action) {
            case 'edit':
                $this->edit();
                break;
            case 'new':
                $this->new($parameter);
                break;
            case 'print':
                $this->print($parameter);
                break;
            case 'show':
                $this->show($parameter);
                break;
            case 'history':
                $this->history($parameter);
                break;
            default:
                break;
        }
    }

    protected function edit()
    {
        $this->editActivate();
    }

    protected function new(array $parameter)
    {
        $this->redirect($parameter['route']);
    }

    protected function print($parameter)
    {
        $id = encryptString($parameter['id']);

        $class = $parameter['pdfClass'];

        $url = action([PDFController::class, 'pdfById'], ['id' => $id, 'class' => $class]);

        $this->dispatch('openWindow', ['url' => $url]);
    }

    protected function show($parameter)
    {
        $nameForm = $parameter['model'];
        $this->dispatch('showModal'.$nameForm, show: true);
    }

    protected function history($parameter)
    {
        $id = $parameter['id'];
        $model = $parameter['model'];
        $this->dispatch('showModalHistory', ['model' => $model, 'id' => $id]);
    }
}
