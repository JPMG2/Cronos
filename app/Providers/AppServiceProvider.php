<?php

declare(strict_types=1);

namespace App\Providers;

use App\Classes\Services\ModelService;
use App\Classes\Utilities\CommonQuerys;
use App\Listeners\LogSuccess;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Patient;
use App\Models\Person;
use App\Observers\EmailModelObserver;
use App\Observers\PatientObserver;
use App\Observers\PersonObserver;
use Carbon\CarbonImmutable;
use Illuminate\Auth\Events\Login;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;

final class AppServiceProvider extends ServiceProvider
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
                    throw new InvalidArgumentException('A valid Eloquent model must be passed to ModelService.');
                }

                return new ModelService($params['model']);
            });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        $this->configureCommands();
        $this->configureModels();
        $this->configureDates();
        $this->configureVite();
        Model::preventLazyLoading(! $this->app->isProduction());
        Model::preventSilentlyDiscardingAttributes(! $this->app->isProduction());
        Model::preventAccessingMissingAttributes(! $this->app->isProduction());

        Branch::observe(EmailModelObserver::class);
        Company::observe(EmailModelObserver::class);
        Person::observe(PersonObserver::class);
        Patient::observe(PatientObserver::class);
        Event::listen(Login::class, LogSuccess::class);
    }

    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            $this->app->isProduction()
        );
    }

    private function configureModels(): void
    {
        Model::shouldBeStrict();
    }

    private function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }

    private function configureVite(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
