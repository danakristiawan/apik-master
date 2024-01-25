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

// auth
// user
Route::get('home', function () {
    return view('home');
})->name('home')->middleware('auth');

// operator
Route::middleware('can:operator')->group(function () {
    Route::controller(App\Http\Controllers\OverviewController::class)->group(function () {
        Route::get('overview', 'index')->name('overview.index');
        Route::get('barchart', 'barChart')->name('overview.barchart');
        Route::get('piechart', 'pieChart')->name('overview.piechart');
        Route::get('detail-per-jenis/{jenis}', 'detailPerJenis')->name('overview.detailperjenis');
    });
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
    Route::resource('ref-kode-transaksi', App\Http\Controllers\RefKodeTransaksiController::class);
    Route::resource('ref-kode-sub-transaksi', App\Http\Controllers\RefKodeSubTransaksiController::class);
    Route::controller(App\Http\Controllers\BniController::class)->group(function () {
        Route::get('bni/lelang', 'lelang')->name('bni.lelang');
        Route::get('bni/piutang', 'piutang')->name('bni.piutang');
        Route::get('bni/{bni}', 'proses')->name('bni.proses');
    });
    Route::controller(App\Http\Controllers\MandiriController::class)->group(function () {
        Route::get('mandiri/lelang', 'lelang')->name('mandiri.lelang');
        Route::get('mandiri/piutang', 'piutang')->name('mandiri.piutang');
        Route::get('mandiri/{mandiri}', 'proses')->name('mandiri.proses');
    });
});
