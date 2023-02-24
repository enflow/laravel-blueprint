<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
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

        Validator::extend('absent', fn ($attribute, $value, $parameters, $validator) => ! Arr::has($validator->getData(), $attribute));

        Carbon::macro('userTimezone', fn () => $this->tz('Europe/Amsterdam')); /** @phpstan-ignore-line */

        Password::defaults(function () {
            $rule = Password::min(8)
                ->letters()
                ->numbers();

            return $this->app->environment(['local', 'testing']) ? $rule : $rule->uncompromised();
        });
    }
}
