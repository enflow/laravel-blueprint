<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('_partials/navigation', function ($view) {
            $view->with('categories', Category::all());
        });
    }

    public function register()
    {
        //
    }
}
