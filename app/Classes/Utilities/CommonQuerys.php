<?php

declare(strict_types=1);

namespace App\Classes\Utilities;

use App\Models\Action;
use App\Models\Company;
use App\Models\Credential;
use App\Models\Degree;
use App\Models\Document;
use App\Models\Gender;
use App\Models\MaritalStatus;
use App\Models\Nationality;
use App\Models\Occupation;
use App\Models\Role;
use App\Models\Specialty;
use App\Models\State;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class CommonQuerys extends Model
{
    public static function stateQuery(array $states): Collection
    {
        return $states[0] !== '*'
            ? State::whereIn('id', $states)->orderBy('state_name')->get()
            : State::orderBy('state_name')->get();
    }

    public static function companyQuery(array $states): Collection
    {
        return $states[0] !== '*'
            ? Company::whereIn('state_id', $states)->orderBy('company_name')->get()
            : Company::orderBy('company_name')->get();
    }

    public static function companyBranchQuery(array $statecompany, array $statebranch): Collection
    {
        $company = $statecompany[0] !== '*' ? Company::whereIn('state_id', $statecompany) : Company::query();
        $branch = $statebranch[0] !== '*'
            ? ['branches' => fn ($query) => $query->whereIn('state_id', $statebranch)->orderBy('branch_name')->with('state')]
            : 'branches.state';

        return $company->with($branch)->get();
    }

    public static function anyCompany(): bool
    {
        return once(fn (): bool => Company::existCompany());
    }

    public static function CompanyOnPause()
    {
        return once(fn () => Company::where('state_id', 2)->first());
    }

    public static function listSpecialties(): Collection
    {
        return Specialty::orderBy('specialty_name')->get();
    }

    public static function listDegrees(): Collection
    {
        return Degree::orderBy('degree_name')->get();
    }

    public static function listCredentials(): Collection
    {
        return Credential::orderBy('credential_name')->get();
    }

    public static function listRoles(?array $roles = null): Collection
    {
        return $roles && $roles !== []
            ? Role::whereNotIn('name_role', $roles)->orderBy('name_role')->get()
            : Role::orderBy('name_role')->get();
    }

    public static function listActions(?array $actions = null): Collection
    {
        return $actions && $actions !== []
            ? Action::whereNotIn('action_name', $actions)->orderBy('action_sp')->get()
            : Action::orderBy('action_sp')->get();
    }

    public static function listDocuments(): Collection
    {
        return Document::orderBy('id')->get();
    }

    public static function listGenders(): Collection
    {
        return Gender::orderBy('gender_name')->get();
    }

    public static function listOcupacion(?string $occupation = null): Collection
    {
        return $occupation
            ? Occupation::whereRaw('LOWER(occupation_name) like ?', ['%'.mb_strtolower($occupation).'%'])
                ->orderBy('occupation_name')->get()
            : Occupation::orderBy('occupation_name')->get();
    }

    public static function listNacionalidad(): Collection
    {
        return Nationality::orderBy('nationality_name')->get();
    }

    public static function listMaritalStatus(): Collection
    {
        return MaritalStatus::orderBy('maritalstatus_name')->get();
    }
}
