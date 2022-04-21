<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, User $user)
    {
        $request->session()->forget(['2fa:user:id', '2fa:user:remember']);

        if ($user->two_factor_secret && ! app()->environment('local')) {
            auth()->logout();

            $request->session()->put('2fa:user:id', $user->id);
            $request->session()->put('2fa:user:remember', $request->has('remember'));

            return redirect(route('login.2fa'));
        }

        return redirect()->intended($this->redirectPath());
    }
}
