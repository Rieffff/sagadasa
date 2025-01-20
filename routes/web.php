<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MaintenanceItemController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/home', function(){return view('blank');})->name('dashboard');
    Route::get('/report', function(){return view('report');})->name('report.index');
    Route::get('/pdf', function(){return view('pdf');})->name('report.pdf');

    Route::get('/contractors', [ContractorController::class, 'index'])->name('master-contractors.index');
    Route::get('/contractors/list', [ContractorController::class, 'list'])->name('master-contractors.list');
    Route::post('/contractors/store', [ContractorController::class, 'store']);
    Route::put('/contractors/{id}', [ContractorController::class, 'update']);
    Route::get('/contractors/show/{id}', [ContractorController::class, 'show']);
    Route::delete('/contractors/{id}', [ContractorController::class, 'destroy']);
    
    Route::get('/daily-activity', function(){return view('daily-activity.index');})->name('daily-activity.index');
    Route::get('/daily-report',function(){return view('daily-report.index');})->name('daily-report.index');
    Route::get('generate-pdf', [PDFController::class, 'generatePDF'])->name('generate-pdf');

    Route::prefix('materials')->group(function () {
        Route::get('/', [MaterialController::class, 'index'])->name('materials.index');
        Route::get('/list', [MaterialController::class, 'list'])->name('materials.list');
        Route::post('/store', [MaterialController::class, 'store'])->name('materials.store');
        Route::get('/show/{material}', [MaterialController::class, 'show'])->name('materials.show');
        Route::put('/update/{material}', [MaterialController::class, 'update'])->name('materials.update');
        Route::delete('/destroy/{material}', [MaterialController::class, 'destroy'])->name('materials.destroy');
    });

    Route::prefix('locations')->group(function () {
        Route::get('/', [LocationController::class, 'index'])->name('locations.index');
        Route::get('/list', [LocationController::class, 'list'])->name('locations.list');
        Route::post('/store', [LocationController::class, 'store'])->name('locations.store');
        Route::get('/show/{location}', [LocationController::class, 'show'])->name('locations.show');
        Route::put('/update/{location}', [LocationController::class, 'update'])->name('locations.update');
        Route::delete('/destroy/{location}', [LocationController::class, 'destroy'])->name('locations.destroy');
    });

    Route::prefix('maintenance-items')->group(function () {
        Route::get('/', [MaintenanceItemController::class, 'index'])->name('maintenance_items.index');
        Route::get('/list', [MaintenanceItemController::class, 'list'])->name('maintenance_items.list');
        Route::post('/store', [MaintenanceItemController::class, 'store'])->name('maintenance_items.store');
        Route::get('/show/{maintenanceItem}', [MaintenanceItemController::class, 'show'])->name('maintenance_items.show');
        Route::put('/update/{maintenanceItem}', [MaintenanceItemController::class, 'update'])->name('maintenance_items.update');
        Route::delete('/destroy/{maintenanceItem}', [MaintenanceItemController::class, 'destroy'])->name('maintenance_items.destroy');
    });
});



require __DIR__.'/auth.php';
