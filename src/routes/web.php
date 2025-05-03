<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::group(['as' => 'contacts.'], function () {
    Route::get('/', [ContactController::class, 'create'])->name('create');
    Route::post('/confirm', [ContactController::class, 'confirm'])->name('confirm');
    Route::post('/thanks', [ContactController::class, 'store'])->name('store');
});

Route::get('/confirm', function () {
    return view('contacts.confirm');
});

Route::post('register', [RegisteredUserController::class, 'store'])->name('register.store');
Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.index');
});
