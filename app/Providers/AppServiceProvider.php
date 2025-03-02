<?php

namespace App\Providers;

use App\Classes\Services\ModelService;
use App\Classes\Utilities\CommonQuerys;
use App\Listeners\LogSuccess;
use App\Models\Branch;
use App\Models\Company;
use App\Observers\EmailModelObserver;
use Illuminate\Auth\Events\Login;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;

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

        $this->app->bind(ModelService::class, /** @throws InvalidArgumentException */
            function ($app, array $params) {
                if (! array_key_exists('model', $params) || ! $params['model'] instanceof Model) {
                    throw new \InvalidArgumentException('A valid Eloquent model must be passed to ModelService.');
                }

                return new ModelService($params['model']);
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
