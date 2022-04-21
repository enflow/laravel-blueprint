<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\User\UserInvite;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email:rfc,dns']);

        /** @var User|null $user */
        $user = User::query()->where('email', $request->get('email'))->first();

        if ($user && $user->invitation_token) {
            $user->notify(new UserInvite());

            throw ValidationException::withMessages([
                __("Your account isn't activated yet. We have re-sent the invite email."),
            ]);
        }
    }
}
