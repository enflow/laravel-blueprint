<?php

Route::auth();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

