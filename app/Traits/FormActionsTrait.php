<?php

namespace App\Traits;

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

        }
    }

    protected function edit()
    {
        $this->editActivate();
    }

    protected function new(array $parameter)
    {
        $this->dispatch('new-form', $parameter[2]);
    }

    protected function print($parameter)
    {
        $idInsurance = $parameter[0];

        $className = $parameter[1];

        $this->dispatch('printByID', ['idmodel' => $idInsurance, 'className' => $className]);
    }

    protected function show($parameter)
    {
        $nameForm = $parameter[3];
        $this->dispatch('showOptionForm', 'showModal'.$nameForm, true);
    }
}
