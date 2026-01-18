<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('landing');
});

// Public asset view (no login required)
Route::get('/asset/{slug}', [AssetController::class, 'publicView'])->name('assets.public');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Assets
    Route::resource('assets', AssetController::class);

    // Master Data
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('areas', AreaController::class)->except(['show']);
    Route::resource('locations', LocationController::class)->except(['show']);
    Route::resource('employees', EmployeeController::class)->except(['show']);

    // API untuk get areas by location
    Route::get('/api/locations/{location}/areas', [AreaController::class, 'getByLocation'])->name('api.areas.by-location');

    // Activity Logs
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');

    // SuperAdmin only
    Route::middleware('role:superadmin')->group(function () {
        // Settings
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

        // User Management
        Route::resource('users', UserController::class)->except(['show']);
    });
});

require __DIR__.'/auth.php';
