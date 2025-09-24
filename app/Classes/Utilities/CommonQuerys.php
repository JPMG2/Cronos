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
            ? State::query()->whereIn('id', $states)->orderBy('state_name')->get()
            : State::query()->orderBy('state_name')->get();
    }

    public static function companyQuery(array $states): Collection
    {
        return $states[0] !== '*'
            ? Company::query()->whereIn('state_id', $states)->orderBy('company_name')->get()
            : Company::query()->orderBy('company_name')->get();
    }

    public static function companyBranchQuery(array $statecompany, array $statebranch): Collection
    {
        $company = $statecompany[0] !== '*' ? Company::query()->whereIn('state_id', $statecompany) : Company::query();
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
        return once(fn () => Company::query()->where('state_id', 2)->first());
    }

    public static function listSpecialties(): Collection
    {
        return Specialty::query()->orderBy('specialty_name')->get();
    }

    public static function listDegrees(): Collection
    {
        return Degree::query()->orderBy('degree_name')->get();
    }

    public static function listCredentials(): Collection
    {
        return Credential::query()->orderBy('credential_name')->get();
    }

    public static function listRoles(?array $roles = null): Collection
    {
        return $roles && $roles !== []
            ? Role::query()->whereNotIn('name_role', $roles)->orderBy('name_role')->get()
            : Role::query()->orderBy('name_role')->get();
    }

    public static function listActions(?array $actions = null): Collection
    {
        return $actions && $actions !== []
            ? Action::query()->whereNotIn('action_name', $actions)->orderBy('action_sp')->get()
            : Action::query()->orderBy('action_sp')->get();
    }

    public static function listDocuments(): Collection
    {
        return Document::query()->orderBy('id')->get();
    }

    public static function listGenders(): Collection
    {
        return Gender::query()->orderBy('gender_name')->get();
    }

    public static function listOcupacion(?string $occupation = null): Collection
    {
        return $occupation
            ? Occupation::query()->whereRaw('LOWER(occupation_name) like ?', ['%'.mb_strtolower($occupation).'%'])
                ->orderBy('occupation_name')->get()
            : Occupation::query()->orderBy('occupation_name')->get();
    }

    public static function listNacionalidad(): Collection
    {
        return Nationality::query()->orderBy('nationality_name')->get();
    }

    public static function listMaritalStatus(): Collection
    {
        return MaritalStatus::query()->orderBy('maritalstatus_name')->get();
    }
}
