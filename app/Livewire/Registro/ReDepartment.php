<?php

declare(strict_types=1);

namespace App\Livewire\Registro;

use App\Livewire\Forms\Registro\DepartmentForm;
use App\Models\Department;
use App\Traits\UtilityForm;
use Livewire\Attributes\Title;
use Livewire\Component;

final class ReDepartment extends Component
{
    use UtilityForm;

    public DepartmentForm $form;

    public $opendepartment = false;

    public $listdeparment;

    #[Title(' - Departamentos')]
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.registro.re-department');
    }

    public function queryDeparmente(): void
    {

        $result = $this->isupdate ?
            $this->form->departmentUpdate() :
            $this->form->departmentStore();
        $messageType = $this->isupdate ? 'msgUpdate' : 'msgCreate';
        $message = $this->showQueryMessage($result, $messageType);
        $this->showToastAndClear($message);
        $this->clearForm();
        $this->opendepartment = false;
    }

    public function clearForm(): void
    {
        $this->form->reset();
        $this->isupdate = false;
    }

    #[\Livewire\Attributes\Computed]
    public function departments()
    {
        return Department::query()->orderBy('department_name')->get();
    }

    public function editDepartment(Department $department): void
    {
        $this->form->loadDataDepartment($department);
        $this->opendepartment = true;
        $this->isupdate = true;

    }
}
