<?php

namespace App\Http\Middleware;

use App\Respondent;
use Closure;

class RespondentMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (!auth()->check()) {
            Respondent::createAndLogin();
        }

        view()->share('respondent', auth()->user());

        return $next($request);
    }
}
