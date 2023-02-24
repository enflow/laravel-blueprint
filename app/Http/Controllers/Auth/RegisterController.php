<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected string $redirectTo = '/register';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data): Validator
    {
        return ValidatorFacade::make($data, [
            'name' => ['required', 'string', 'max:190'],
            'email' => ['required', 'email:dns,rfc', 'unique:users'],
            'terms_of_service' => ['accepted'],
        ]);
    }

    public function register(Request $request): mixed
    {
        $this->validator($request->all())->validate();

        event(new Registered($this->create($request->all())));

        return back()->withSuccess(__('Thanks! We\'ve send an invite email to :email to confirm your registration.', ['email' => $request->string('email')]));
    }

    protected function create(array $data): User
    {
        $user = User::create(Arr::only($data, ['name', 'email']) + [
            'locale' => app()->getLocale(),
            'invitation_token' => Str::random(64),
        ]);

        // try {
        //     $user->notify(new UserInvite());
        // } catch (ClientException|Swift_TransportException|Swift_RfcComplianceException $e) {
        //     logger('Sending invite failed: '.$e->getMessage());
        // }

        return $user;
    }
}
