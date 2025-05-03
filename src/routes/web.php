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
    Route::post('/', [ContactController::class, 'store'])->name('store');
    Route::get('/thanks', [ContactController::class, 'thanks'])->name('thanks');
});

Route::post('register', [RegisteredUserController::class, 'store'])->name('register.store');
Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
});
