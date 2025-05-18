<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HouseholdController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckInviteCode;
use App\Http\Middleware\PasswordProtectSignup;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'render')->name('login');
    Route::post('login', 'authenticate');
    Route::post('logout', 'logout');
});
Route::view('success', 'success');

// Sign Up
Route::controller(SignupController::class)->group(function () {
    Route::get('signup', 'render');
    Route::post('signup', 'create')->middleware(PasswordProtectSignup::class);
});

// Join household
Route::controller(HouseholdController::class)->middleware(CheckInviteCode::class)->group(function () {
    Route::get('household/join/{uuid}', 'join')->name('household.join');
    Route::post('household/join/{uuid}', 'createAndAddUserToHousehold')->name('household.createAndAddUserToHousehold');
});
Route::view('invalid-invite', 'invalidInvite');

// Authed routes
Route::middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard.render');

    Route::resource('plans', PlanController::class)->only(['index']);

    Route::controller(HouseholdController::class)->group(function () {
        Route::get('household', 'render')->name('household.render');
        Route::get('household/add-user', 'addUser')->name('household.addUser');
    });

    Route::controller(UserController::class)->group(function () {
        Route::delete("users/{id}", "delete");
    });
});
