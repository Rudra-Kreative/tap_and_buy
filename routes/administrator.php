<?php

use App\Http\Controllers\Administrator\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Administrator\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Administrator\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Administrator\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Administrator\Auth\NewPasswordController;
use App\Http\Controllers\Administrator\Auth\PasswordResetLinkController;
use App\Http\Controllers\Administrator\Auth\RegisteredUserController;
use App\Http\Controllers\Administrator\Auth\VerifyEmailController;
use App\Http\Controllers\Administrator\BusinessController;
use App\Http\Controllers\Administrator\DashboardController;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'administrator', 'as' => 'administrator.'], function () {

    Route::group(['middleware' => ['auth:administrator']], function () {

        Route::get('/', [DashboardController::class, 'index']);

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');

        Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

        Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['throttle:6,1'])->name('verification.send');

        Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');

        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        // Admin businesses CRUD
        Route::get('/businesses_list', [BusinessController::class, 'index'])->name('businesses_list');
    });

    Route::group(['middleware' => ['guest:administrator']], function () {


        Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

        Route::post('/register', [RegisteredUserController::class, 'store']);

        Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

        Route::post('/login', [AuthenticatedSessionController::class, 'store']);

        Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');

        Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

        Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');

        Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
    });
});
