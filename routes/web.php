<?php

use GuzzleHttp\Middleware;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('home', function () {
        return view('dashboard.home');
    })->name('home');

    Route::get('change-profile', function () {
        return view('dashboard.profile');
    })->name('profile');

    Route::get('change-password', function () {
        return view('dashboard.password');
    })->name('password');
});
