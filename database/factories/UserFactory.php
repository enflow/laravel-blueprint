<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$12$XNenmnTgxTyJ4qg8/gNQI.LV7PoxCQgP.ySHgkD8r2QyaG1VQJBc.', // secret123
        'remember_token' => Str::random(10),
    ];
});
