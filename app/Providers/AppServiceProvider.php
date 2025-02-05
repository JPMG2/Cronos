<?php

namespace App\Providers;

use App\Classes\Utilities\CommonQuerys;
use App\Listeners\LogSuccess;
use App\Models\Branch;
use App\Models\Company;
use App\Observers\EmailModelObserver;
use Illuminate\Auth\Events\Login;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('commonquery', function ($app) {
            return new CommonQuerys;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(! $this->app->isProduction());
        Model::preventSilentlyDiscardingAttributes(! $this->app->isProduction());
        Model::preventAccessingMissingAttributes(! $this->app->isProduction());

        Branch::observe(EmailModelObserver::class);
        Company::observe(EmailModelObserver::class);

        Event::listen(Login::class, LogSuccess::class);
    }
}
