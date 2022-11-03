<?php

use Illuminate\Support\Facades\Route;

require 'web/auth.php';

Route::view('dashboard', 'dashboard.index');
