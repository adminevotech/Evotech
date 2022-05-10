<?php

use App\Http\Controllers\Api\Client\ClientController;
use App\Http\Controllers\Api\Client\StaticContentController;
use App\Http\Controllers\Api\Client\AuthController;
use App\Http\Controllers\Api\Client\BlogController;
use App\Http\Controllers\Api\Client\CommunicationController;
use App\Http\Controllers\Api\Client\PortfolioController;
use App\Http\Controllers\Api\Client\ServiceController;
use App\Http\Controllers\Api\Client\SubscriptionController;
use App\Http\Controllers\Api\OTPController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale()
    ], function(){

        Route::get('/static-content', [StaticContentController::class, 'index'])->name('static.content.index');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/register', [AuthController::class, 'register'])->name('register');


        Route::post('/contact-us', [CommunicationController::class, 'communicate'])->name('communications.sendEmail');
        Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscriptions.subscribe');
        Route::post('send-reset-password-link', [AuthController::class, 'sendResetPasswordLink']);
        Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password');

        Route::resource('services', ServiceController::class)->only('index', 'show');
        Route::resource('clients', ClientController::class)->only('index', 'show');
        Route::resource('blogs', BlogController::class)->only('index', 'show');
        Route::resource('portfolios', PortfolioController::class)->only('index', 'show');

        Route::middleware('auth:api')->group(function(){
            Route::middleware('OTP')->group(function(){
                Route::post('verify', [OTPController::class, 'verify']);
                Route::post('send-verification-code', [OTPController::class, 'sendVerificationCode']);
            });

            Route::middleware('Verified')->group(function () {
                Route::get('/test', function(){ echo "client auth and ver";});

                Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password');
                Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
            });
        });
});
