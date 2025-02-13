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

    protected function getQueryValues()
    {
        if (empty($this->columName)) {
            return;
        }

        return $this->columName;

    }

    public function makeQuery($query)
    {
        return $this->getQueryValues() === null ? $query :
            $query->orderBy($this->getQueryValues(), $this->sortDirection ? 'asc' : 'desc');
    }

    private function resetOrdersValues()
    {
        $this->columName = null;
        $this->sortDirection = false;
    }

    public function updatedSortField()
    {
        dd($this->filtervalue);
    }
}
