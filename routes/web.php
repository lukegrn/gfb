<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlanController;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'render')->name('login');
    Route::post('login', 'authenticate');
    Route::post('logout', 'logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard.index');

    Route::resource('plans', PlanController::class)->only(['index']);
});
