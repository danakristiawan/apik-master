<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Manual Login
Route::controller(App\Http\Controllers\Auth\LoginController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('authenticate', 'authenticate')->name('authenticate');
});
Route::controller(App\Http\Controllers\Auth\RegisterController::class)->group(function () {
    Route::get('auth/register', 'create')->name('auth.register');
    Route::post('auth/store', 'store')->name('auth.store');
});
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout')->middleware('auth');

// Login Using SSO
Route::controller(App\Http\Controllers\Auth\SsoController::class)->group(function () {
    Route::get('redirect', 'redirect')->name('redirect');
    Route::get('callback', 'callback')->name('callback');
    Route::get('signout', 'signout')->name('signout')->middleware('auth');
});

Route::get('home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::get('chart', 'App\Http\Controllers\ChartController@index')->name('chart');
