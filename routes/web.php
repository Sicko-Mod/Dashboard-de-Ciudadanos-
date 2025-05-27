<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/city/{id}', [DashboardController::class, 'showCity'])->name('city.show');
