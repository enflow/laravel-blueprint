@component('mail::message')
Beste {{ $user->first_name }},

Je hebt ons gevraagd het wachtwoord te herstellen van uw account. Klik op de onderstaande knop om een nieuw wachtwoord in te stellen.

@component('mail::button', ['url' => route('password.reset', ['token' => $token, 'email' => $user->email, 'utm_source' => 'user', 'utm_medium' => 'email'])])
Wachtwoord herstellen
@endcomponent
@endcomponent
