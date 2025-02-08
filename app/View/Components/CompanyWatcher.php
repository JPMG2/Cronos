<?php

namespace App\View\Components;

use App\Classes\Utilities\CommonQuerys;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class CompanyWatcher extends Component
{
    public function __construct(readonly CommonQuerys $commonQuerys) {}

    public function render(): View|Closure|string
    {
        $this->anyCompany();
        $this->companyOnPause();

        return view('components.company-watcher');
    }

    public function anyCompany(): bool
    {
        if (! $this->commonQuerys::anyCompany()) {
            Session::flash('status', ['Por favor debe registrar una empresa.', 'error']);
            Session::flash('isdisabled', 'disabled');

            return false;
        }
        Session::forget(['status', 'isdisabled']);

        return true;
    }

    public function companyOnPause()
    {
        if ($this->commonQuerys::CompanyOnPause()) {
            Session::flash('status', ['Compañia BLOQUEADA, notificar al administrador del sistema.', 'warning']);
            Session::flash('isdisabled', 'disabled');

            return true;
        }
        Session::forget(['status', 'isdisabled']);

        return false;
    }
}
