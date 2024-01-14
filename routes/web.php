<?php

use Illuminate\Support\Facades\Route;

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

// middleware auth
// user
Route::get('home', function () {
    return view('home');
})->name('home')->middleware('auth');

// operator
Route::middleware('can:operator')->group(function () {
    Route::resource('overview', App\Http\Controllers\OverviewController::class);
    Route::resource('rekening-koran', App\Http\Controllers\RekeningKoranController::class);
    Route::resource('jurnal', App\Http\Controllers\JurnalController::class);
    Route::resource('pelaporan', App\Http\Controllers\PelaporanController::class);
    Route::resource('pembukuan', App\Http\Controllers\PembukuanController::class);
});

// supervisor
Route::middleware('can:supervisor')->group(function () {
});

// manager
Route::middleware('can:manager')->group(function () {
    Route::view('referensi', 'referensi')->name('referensi');
    Route::view('utilitas', 'utilitas')->name('utilitas');
    Route::resource('ref-satker', App\Http\Controllers\RefSatkerController::class);
    Route::resource('ref-bank', App\Http\Controllers\RefBankController::class);
    Route::resource('ref-menu', App\Http\Controllers\RefMenuController::class);
    Route::resource('user', App\Http\Controllers\UserController::class);

});


// Route::get('chart', 'App\Http\Controllers\ChartController@index')->name('chart');

// Route::get('overview', function () {
//     return view('overview');
// })->name('overview')->middleware('can:operator');

