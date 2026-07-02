<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\ApplicationController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/jobs', [VacancyController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}', [VacancyController::class, 'show'])->name('jobs.show');

Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
Route::get('/applications/{id}', [ApplicationController::class, 'show'])->name('applications.show');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/notifications', function () {
    return view('notifications');
})->name('notifications');

Route::get('/messages', function () {
    return view('messages');
})->name('messages');

Route::get('/saved-jobs', function () {
    return view('saved-jobs');
})->name('saved-jobs');

Route::get('/help', function () {
    return view('help');
})->name('help');