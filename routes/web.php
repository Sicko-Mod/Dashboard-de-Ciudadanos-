<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ReportCitizenController;
use App\Http\Controllers\CitizenController; // Importa el nuevo CitizenController



// Public routes (if any, current dashboard is not authenticated)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
// Note: We are keeping city.show public as per original request, but it might be moved into auth later
Route::get('/city/{id}', [DashboardController::class, 'showCity'])->name('city.show');


// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // City management routes
    Route::resource('cities', CityController::class);

    // Profile routes
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    // Report sending route
    Route::post('/report/send', [ReportCitizenController::class, 'sendReport'])->name('report.send');

    // New Citizen Routes (nested under cities)
    Route::prefix('cities/{city}')->group(function () {
        Route::get('/citizens/create', [CitizenController::class, 'create'])->name('citizens.create');
        Route::post('/citizens', [CitizenController::class, 'store'])->name('citizens.store');
    });
    Route::delete('/citizens/{citizen}', [CitizenController::class, 'destroy'])->name('citizens.destroy');
});

require __DIR__.'/auth.php';