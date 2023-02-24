<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\User\UserInvite;
use App\User;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Honeypot\ProtectAgainstSpam;
use Swift_RfcComplianceException;
use Swift_TransportException;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/register';

    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware(ProtectAgainstSpam::class);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:190'],
            'email' => ['required', 'email:dns,rfc', 'unique:users'],
            'company_name' => ['required', 'string', 'max:190'],
            'company_email' => ['required', 'string', 'email:dns,rfc'],
            'terms_of_service' => ['accepted'],
            'dpa' => ['accepted'],
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return back()
            ->withSuccess(__('Thanks! We\'ve send an invite email to :email to confirm your registration.', ['email' => $request->get('email')]));
    }

    protected function create(array $data)
    {
        [$user, $tenant] = DB::transaction(function () use ($data) {
            $tenant = Tenant::create([
                'name' => $data['company_name'],
                'email' => $data['company_email'],
                'reply_to' => $data['company_email'],
                'locale' => app()->getLocale(),
                'trial_ends_at' => now()->addDays(config('registration.trial_duration_in_days'))->endOfDay(),
            ]);

            $user = User::create(Arr::only($data, ['name', 'email']) + [
                'locale' => app()->getLocale(),
                'role' => User::TENANT_MANAGER,
                'invitation_token' => Str::random(64),
            ]);

            // Assign tenant to user.
            $user->tenants()->sync([$tenant->id]);

            return [$user, $tenant];
        });

        $tenant->makeCurrent();

        try {
            $user->notify(new UserInvite());
        } catch (ClientException|Swift_TransportException|Swift_RfcComplianceException $e) {
            logger('Sending invite failed: '.$e->getMessage());
        }

        return $user;
    }
}
