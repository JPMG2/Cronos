<?php

declare(strict_types=1);

namespace App\Livewire\Configuracion;

use App\Livewire\Forms\Configuracion\ActionsForm;
use App\Traits\UtilityForm;
use Livewire\Attributes\Title;
use Livewire\Component;

final class ReActions extends Component
{
    use UtilityForm;

    public ActionsForm $actionForm;

    #[Title(' - Permisos')]
    public function render()
    {
        $this->commonQuerys = app('commonquery');

        return view(
            'livewire.configuracion.re-actions',
            [
                'listRoles' => $this->commonQuerys::listRoles(['Owner']),
                'listActions' => $this->commonQuerys::listActions(['login', 'logout']),
            ]
        );
    }

    public function queryActionRole()
    {
        $result = app()->call([$this->actionForm, 'actionStore']);
        $this->endAction($result);
    }

    public function endAction($result)
    {
        $this->dispatch('show-toast', $result);
        $this->clearForm();

    }

    public function clearForm()
    {
        $this->actionForm->reset();
        $this->isupdate = false;
    }

    public function roleValue()
    {
        app()->call([$this->actionForm, 'actionData'], ['intRole' => $this->actionForm->dataaction['role_id']]);
    }
}
