<?php

use LionRoute\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

/**
 * ------------------------------------------------------------------------------
 * Web Routes
 * ------------------------------------------------------------------------------
 * Here is where you can register web routes for your application
 * ------------------------------------------------------------------------------
 **/

Route::get('/', [HomeController::class, 'index']);