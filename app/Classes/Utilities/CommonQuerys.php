<?php

declare(strict_types=1);

namespace App\Classes\Utilities;

use App\Models\Action;
use App\Models\Company;
use App\Models\Credential;
use App\Models\Degree;
use App\Models\Document;
use App\Models\Gender;
use App\Models\Role;
use App\Models\Specialty;
use App\Models\State;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class CommonQuerys extends Model
{
    public static function stateQuery(array $states): Collection
    {
        if ($states[0] !== '*') {
            return State::whereIn('id', $states)->orderBy('state_name')->get();
        }

        return State::orderBy('state_name')->get();

    }

    public static function companyQuery(array $states): Collection
    {
        if ($states[0] !== '*') {
            return Company::orderBy('company_name')->whereIn('state_id', $states)->get();
        }

        return Company::orderBy('company_name')->get();

    }

    public static function companyBranchQuery(array $statecompany, array $statebranch): Collection
    {

        $company = $statecompany[0] !== '*' ? Company::whereIn('state_id', $statecompany) : Company::query();
        $branch = $statebranch[0] !== '*' ? ['branches' => function ($query) use ($statebranch) {
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

    public static function listSpecialties()
    {
        return Specialty::orderBy('specialty_name')->get();
    }

    public static function listDegrees()
    {
        return Degree::orderBy('degree_name')->get();
    }

    public static function listCredentials()
    {
        return Credential::orderBy('credential_name')->get();
    }

    public static function listRoles(?array $roles = null)
    {
        if ($roles) {
            return Role::whereNotIn('name_role', $roles)->orderBy('name_role')->get();
        }

        return Role::orderBy('name_role')->get();
    }

    public static function listActions(?array $actions = null)
    {
        if ($actions) {
            return Action::whereNotIn('action_name', $actions)->orderBy('action_sp')->get();
        }

        return Action::orderBy('action_sp')->get();
    }

    public static function listDocuments()
    {
        return Document::orderBy('id')->get();
    }

    public static function listGenders()
    {
        return Gender::orderBy('gender_name')->get();
    }
}
