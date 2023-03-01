<?php

use Illuminate\Support\Facades\Route;

require 'web/auth.php';

Route::view('', 'home.index');
Route::view('stylesheet', 'stylesheet.index');
