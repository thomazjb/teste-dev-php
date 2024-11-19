<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'store'])
    ->middleware('guest')
    ->name('register');

Route::post('/login', [UserController::class, 'login'])
    ->middleware('guest')
    ->name('login');

Route::post('/forgot-password', [UserController::class, 'passwordReset'])
    ->middleware('guest')
    ->name('password.email');

Route::post('/reset-password', [UserController::class, 'newPassword'])
    ->middleware('guest')
    ->name('password.store');
