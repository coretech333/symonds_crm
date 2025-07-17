<?php

use App\Http\Controllers\TurfController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Sport\SportController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::apiResource('sports',SportController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('turfs', TurfController::class);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
