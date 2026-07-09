<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.process');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated User
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return redirect()->route('profile');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::patch('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    /*
    |--------------------------------------------------------------------------
    | Jobs
    |--------------------------------------------------------------------------
    */

    Route::get('/jobs', [VacancyController::class, 'index'])
        ->name('jobs.index');

    Route::get('/jobs/{id}', [VacancyController::class, 'show'])
        ->name('jobs.show');

    /*
    |--------------------------------------------------------------------------
    | Applications
    |--------------------------------------------------------------------------
    */

    Route::get('/applications', [ApplicationController::class, 'index'])
        ->name('applications.index');

    Route::post('/applications', [ApplicationController::class, 'store'])
        ->name('applications.store');

    Route::get('/applications/{id}', [ApplicationController::class, 'show'])
        ->name('applications.show');

    /*
    |--------------------------------------------------------------------------
    | Other Pages
    |--------------------------------------------------------------------------
    */

    Route::view('/notifications', 'notifications')
        ->name('notifications');

    Route::view('/messages', 'messages')
        ->name('messages');

    Route::view('/saved-jobs', 'saved-jobs')
        ->name('saved-jobs');

    Route::view('/help', 'help')
        ->name('help');

});