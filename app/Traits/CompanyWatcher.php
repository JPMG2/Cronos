<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\Session;

trait CompanyWatcher
{
    protected $commonQuerys;

    public function anyCompany(): bool
    {
        if (! $this->commonQuerys::anyCompany()) {
            Session::flash('status', ['Por favor debe registrar una empresa.', 'error']);

            return false;
        }

        return true;
    }

    public function companyOnPause(): bool
    {
        if ($this->commonQuerys::companyOnPause()) {
            Session::flash('status', ['Compañia BLOQUEADA, notificar al administrador del sistema.', 'warning']);

            return true;
        }

        return false;
    }
}
