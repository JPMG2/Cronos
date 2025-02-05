<?php

namespace App\Livewire\Registro;

use App\Livewire\Forms\Registro\DepartmentForm;
use App\Models\Department;
use App\Traits\UtilityForm;
use Livewire\Attributes\Title;
use Livewire\Component;

class ReDepartment extends Component
{
    use UtilityForm;

    public DepartmentForm $form;

    public $opendepartment = false;

    public $departmentobject;

    public $listdeparment;

    protected $commonQuerys;

    #[Title(' - Departamentos')]
    public function render()
    {
        $this->breadcrumbs = exploBreadcrum($this->getBreadcrumbs('Departamentos'));
        $this->commonQuerys = app('commonquery');

        return view('livewire.registro.re-department', [
            'listBranches' => $this->commonQuerys::companyBranchQuery([1], [1]),
            'listState' => $this->commonQuerys::stateQuery([1, 2]),
        ]);
    }

    public function queryDeparmente()
    {

        if (! ($this->isupdate)) {

            $result = app()->call([$this->form, 'departmentStore']);

        } else {
            $result = app()->call([$this->form, 'departmentUpdate'], ['modelDepartment' => $this->departmentobject]);

        }
        $this->dispatch('show-toast', $result);
        $this->isupdate = false;
        $this->clearForm();

    }

    public function clearForm()
    {
        $this->form->reset();
        $this->opendepartment = false;

    }

    public function getDepartmentsProperty()
    {
        return Department::query()->orderBy('department_name')->get();
    }

    public function openDepartment()
    {
        $this->opendepartment = true;
    }

    public function editDepartment(Department $department)
    {
        $this->form->datadeparment['department_name'] = $department->department_name;
        $this->form->datadeparment['department_code'] = $department->department_code;
        $this->opendepartment = true;
        $this->isupdate = true;
        $this->departmentobject = $department;
    }
}
