<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManageController;
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
    Route::get('/logout', 'logout');
});
Route::group([
    "middleware" => ["auth"]
], function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/profile', 'getProfile')->name('profile.page');
        Route::post('/profile/name/modify', 'modifyNickname');
        Route::post('/team/modify', 'modifyTeamSelf');
        Route::get('/user', 'getUserManage')->name('user.page');
        Route::post('/user/create', 'createUser')->name('user.create');
    });
    Route::controller(ManageController::class)->group(function () {
        Route::get('/teams', 'index')->name("teams.page");
        Route::post('/team/create', 'createTeam');
    });
});