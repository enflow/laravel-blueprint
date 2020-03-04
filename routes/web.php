<?php

use Illuminate\Support\Facades\Route;

require 'web/auth.php';

Route::view('/', 'dashboard.index')->name('dashboard.index');

Route::group(['middleware' => 'auth'], function () {
    // Route::get('/mijn-account', 'AccountController@index')->name('account.index');
});
