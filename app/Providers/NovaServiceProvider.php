<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    protected function routes(): void
    {
        Nova::routes()
            // ->withAuthenticationRoutes()
            // ->withPasswordResetRoutes()
            ->register();
    }

    protected function gate(): void
    {
        Gate::define('viewNova', fn ($user) => Str::endsWith($user->email, '@enflow.nl'));
    }

    /**
     * @return \Laravel\Nova\Dashboard[]
     */
    protected function dashboards(): array
    {
        return [
            new \App\Nova\Dashboards\Main(),
        ];
    }

    /**
     * @return \Laravel\Nova\Tool[]
     */
    public function tools(): array
    {
        return [];
    }

    public function register(): void
    {
        //
    }
}
