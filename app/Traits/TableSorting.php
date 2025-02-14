<?php

namespace App\Traits;

trait TableSorting
{
    public $sortField;

    public $columName;

    public $filtervalue;

    public $sortDirection = false;

    public function orderColumBy($columValue)
    {
        if ($this->columName === $columValue) {
            $this->sortDirection = ! $this->sortDirection;
        } else {
            $this->sortDirection = true;
        }
        $this->columName = $columValue;
    }

    public function makeQueryByColumn($query)
    {
        return $this->getQueryValues() === null ? $query : $this->buildQuery($query);

    }

    protected function getQueryValues(): ?string
    {
        if (empty($this->columName)) {
            return null;
        }

        return $this->columName;

    }

    public function buildQuery($query)
    {

        return $query->orderBy($this->getQueryValues(), $this->sortDirection ? 'asc' : 'desc');

    }

    public function makeQueryBySearch($stringvalue, $query)
    {
        $stringvalue = ucfirst(strtolower($stringvalue));

        return $query->where($this->filtervalue, 'like', '%'.$stringvalue.'%')
            ->orderBy($this->filtervalue, $this->sortDirection ? 'asc' : 'desc');
    }

    public function inicializteTableSorting($modelName)
    {
        $model = 'App\\Models\\'.$modelName;

        $this->resetPage();
        $this->resetOrdersValues();
        $this->filtervalue = $model::$startFilterBay;
    }

    private function resetOrdersValues()
    {
        $this->columName = null;
        $this->sortDirection = false;
        $this->sortField = null;
    }
}
