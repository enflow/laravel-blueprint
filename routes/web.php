<?php

Route::auth();

// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/', 'DashboardController@index')->name('dashboard.index');
// });

Route::view('/voorstel', 'views.voorstel');
Route::view('/admin/dashboard', 'views.admin.dashboard');

