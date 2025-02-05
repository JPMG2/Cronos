<?php

namespace App\Classes\Utilities;

use App\Models\Company;
use App\Models\State;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CommonQuerys extends Model
{
    public static function stateQuery(array $states): Collection
    {
        if ($states[0] != '*') {
            return State::whereIn('id', $states)->orderBy('state_name')->get();
        } else {
            return State::orderBy('state_name')->get();
        }

    }

    public static function companyQuery(array $states): Collection
    {
        if ($states[0] != '*') {
            return Company::orderBy('company_name')->whereIn('state_id', $states)->get();
        } else {
            return Company::orderBy('company_name')->get();
        }

    }

    public static function companyBranchQuery(array $statecompany, array $statebranch): Collection
    {

        $company = $statecompany[0] != '*' ? Company::whereIn('state_id', $statecompany) : Company::query();
        $branch = $statebranch[0] != '*' ? ['branches' => function ($query) use ($statebranch) {
            $query->whereIn('state_id', $statebranch)->orderBy('branch_name')->with('state');
        }] : 'branches.state';

        return $company->with($branch)->get();

    }

    public static function anyCompany(): bool
    {
        return (bool) Company::existCompany();
    }

    public static function CompanyOnPause()
    {
        return Company::where('state_id', 2)->first();
    }
}
