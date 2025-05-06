<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Auth routes
Auth::routes();

// Dashboard (domain management)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DomainController::class, 'index'])->name('dashboard');
    Route::resource('/domains', DomainController::class)->except(['create', 'edit', 'show']);
});

// Plans
Route::middleware(['auth'])->group(function () {
    Route::get('/plans', [PlanController::class, 'index'])->name('plans');
    Route::post('/plans/{plan}/buy', [PlanController::class, 'buy'])->name('plans.buy');
});

// Admin routes
Route::middleware(['auth', 'can:view-admin-pages'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
