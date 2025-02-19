<?php

namespace App\Classes\Registro;

use App\Models\Branch;
use App\Traits\UtilityForm;

class BranchObj
{
    use UtilityForm;

    protected $modelName = 'Branch';

    /**
     * Store a new branch in the database.
     *
     * @param  array  $arrayBranch  The array containing the branch data.
     * @return Branch The created branch.
     */
    public function store(array $arrayBranch): Branch
    {
        return Branch::create($this->getValuesModel($arrayBranch, $this->modelName));
    }

    /**
     * Display the details of a branch.
     *
     * @param  int  $id  The ID of the branch.
     */
    public function show(int $id): Branch
    {
        return Branch::with('city.province', 'state')->findOrFail($id);

    }

    /**
     * Update a branch in the database.
     *
     * @param  int  $branchId  The ID of the branch.
     * @param  array  $arrayBrach  The array containing the branch data.
     * @return Branch The updated branch.
     */
    public function update($branchId, array $arrayBrach): Branch
    {
        $branch = Branch::findOrFail($branchId);

        $branch->update($this->getValuesModel($arrayBrach, $this->modelName));

        return $branch;

    }
}
