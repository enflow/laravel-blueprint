<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    protected function routes()
    {
        Nova::routes()
            // ->withAuthenticationRoutes()
            // ->withPasswordResetRoutes()
            ->register();
    }

    protected function gate()
    {
        Gate::define('viewNova', fn ($user) => Str::endsWith($user->email, '@enflow.nl'));
    }

    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    public function tools()
    {
        return [];
    }

    public function register()
    {
        //
    }
}
