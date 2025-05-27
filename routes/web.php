<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ReportCitizenController;

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

// Public routes (if any, current dashboard is not authenticated)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/city/{id}', [DashboardController::class, 'showCity'])->name('city.show');


// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard route (already exists, but ensuring it's under auth)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // City management routes
    Route::resource('cities', CityController::class);

    // Profile routes
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    // Report sending route
    Route::post('/report/send', [ReportCitizenController::class, 'sendReport'])->name('report.send');
});

require __DIR__.'/auth.php';