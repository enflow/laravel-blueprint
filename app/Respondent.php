<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Respondent extends Authenticatable
{
    public $guarded = [];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public static function createAndLogin()
    {
        if (auth()->check()) {
            auth()->logout();
        }

        $respondent = static::create([
            'uuid' => Str::uuid(),
        ]);

        auth()->login($respondent);

        return $respondent;
    }

    public function setRememberToken($token)
    {
        //
    }
}
