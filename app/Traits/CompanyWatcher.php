<?php

declare(strict_types=1);

namespace App\Traits;

use App\Classes\Utilities\CommonQuerys;
use Illuminate\Support\Facades\Session;

trait CompanyWatcher
{
    protected $commonQuerys;

    public function anyCompany(CommonQuerys $commonQuerys): bool
    {
        if (! $this->commonQuerys::anyCompany()) {
            Session::flash('status', ['Por favor debe registrar una empresa.', 'error']);

            return false;
        }

        return true;
    }

    public function companyOnPause(CommonQuerys $commonQuerys): bool
    {
        if ($this->commonQuerys::CompanyOnPause()) {
            Session::flash('status', ['Compañia BLOQUEADA, notificar al administrador del sistema.', 'warning']);

            return true;
        }

        return false;
    }
}
