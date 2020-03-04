<?php

use Illuminate\Support\Facades\Route;

Route::get('inloggen', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('inloggen', 'Auth\LoginController@login')->name('login.action');
Route::post('uitloggen', 'Auth\LoginController@logout')->name('logout');

Route::get('registreren', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('registreren', 'Auth\RegisterController@register')->name('register.action');

Route::get('wachtwoord-vergeten/resetten', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('wachtwoord-vergeten/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('wachtwoord-vergeten/resetten/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('wachtwoord-vergeten/resetten', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('uitnodiging/bevestigen/{token}', 'Auth\InviteConfirmationController@index')->name('invite-confirmation.index')->middleware('guest');
Route::post('uitnodiging/bevestigen', 'Auth\InviteConfirmationController@confirm')->name('invite-confirmation.confirm')->middleware('guest');

//Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('login', 'Auth\LoginController@login');
//Route::post('logout', 'Auth\LoginController@logout')->name('logout');
//
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');
//
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
//
//Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
//Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');
//
//Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
//Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
//Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
