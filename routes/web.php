<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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

Route::redirect('/', '/login', 302);
Route::get('/register', function () {
    return  view('register');
});
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::controller(UserController::class)->group(function () {
    Route::post('/login', 'loginAuth')->name('login.auth');
    Route::post('/register', 'storeRegister')->name('register.store');
});
Route::group([
    "middleware" => ["auth"]
], function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/profile', 'getProfile');
    });
});