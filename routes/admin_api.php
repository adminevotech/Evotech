<?php

use App\Http\Controllers\Api\Admin\ActivityLogController;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\BlogController;
use App\Http\Controllers\Api\Admin\ClientController;
use App\Http\Controllers\Api\Admin\PermissionController;
use App\Http\Controllers\Api\Admin\PortfolioController;
use App\Http\Controllers\Api\Admin\StaticContentController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\RoleController;
use App\Http\Controllers\Api\Admin\ServiceController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group([
    'prefix' => LaravelLocalization::setLocale()
    ], function(){

        Route::prefix('/admin')->name('admin.')->group(function(){
            Route::post('/login', [AuthController::class, 'login'])->name('login');
            Route::middleware('auth:api', 'admin')->group(function () {
                Route::get('/test', function(){ echo "admin auth and ver";});

                Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password');
                Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

                Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity.log.index');
                Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');

                Route::resource('static-content', StaticContentController::class)->only('index', 'update');

                Route::resources([
                    "users" => UserController::class,
                    "roles" => RoleController::class,
                    "services" => ServiceController::class,
                    "clients" => ClientController::class,
                    "blogs" => BlogController::class,
                    "portfolios" => PortfolioController::class,
                ]);
            });
        });

});





