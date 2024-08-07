<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    public const string HOME = '/';

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Model::unguard();

        Model::preventLazyLoading($this->app->isLocal());

        Relation::enforceMorphMap([

        ]);

        Carbon::macro('userTimezone', fn () => $this->tz('Europe/Amsterdam')); /** @phpstan-ignore-line */
        Password::defaults(function () {
            $rule = Password::min(8)
                ->letters()
                ->numbers();

            return $this->app->environment(['local', 'testing']) ? $rule : $rule->uncompromised();
        });
    }
}
