<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MaintenanceItemController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DailyReportController;
use App\Http\Controllers\MaintenanceLogController;
use App\Http\Controllers\MaterialReplacementController;
use App\Http\Controllers\PhotoController;




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


    Route::prefix('devices')->group(function () {
        Route::get('/', [DeviceController::class, 'index'])->name('devices.index');
        Route::get('/list', [DeviceController::class, 'fetchDevices'])->name('devices.list');
        Route::get('/show/{device}', [DeviceController::class, 'show'])->name('devices.show');
        Route::post('/store', [DeviceController::class, 'store'])->name('devices.store');
        Route::put('/update/{device}', [DeviceController::class, 'update'])->name('devices.update');
        Route::delete('/destroy/{device}', [DeviceController::class, 'destroy'])->name('devices.destroy');
    });

    Route::controller(CompanyController::class)->prefix('companies')->group(function () {
        Route::get('/', 'index')->name('companies.index');
        Route::get('/list', 'fetch')->name('companies.list');
        Route::get('/show/{id}', 'show')->name('companies.show');
        Route::post('/store', 'store')->name('companies.store');
        Route::put('/update/{id}', 'update')->name('companies.update');
        Route::delete('/destroy/{id}', 'destroy')->name('companies.destroy');
    });

    // Route::resource('users', UserController::class);
    Route::get('user/show/{id}', [UserController::class,'show']);
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::delete('user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::put('user/update/{id}', [UserController::class, 'update'])->name('user.update');


    Route::prefix('daily-reports')->group(function () {
        Route::get('/', [DailyReportController::class, 'index']); // Fetch all reports
        Route::post('/', [DailyReportController::class, 'store']); // Create a report
        Route::put('/{id}', [DailyReportController::class, 'update']); // Update a report
        Route::delete('/{id}', [DailyReportController::class, 'destroy']); // Delete a report
    });


    Route::prefix('maintenance-logs')->group(function () {
        Route::get('/', [MaintenanceLogController::class, 'index']); // Fetch all maintenance logs
        Route::post('/', [MaintenanceLogController::class, 'store']); // Create a maintenance log
        Route::put('/{id}', [MaintenanceLogController::class, 'update']); // Update a maintenance log
        Route::delete('/{id}', [MaintenanceLogController::class, 'destroy']); // Delete a maintenance log
    });

    Route::prefix('material-replacements')->group(function () {
        Route::get('/', [MaterialReplacementController::class, 'index']); // Fetch all material replacements
        Route::post('/', [MaterialReplacementController::class, 'store']); // Create a material replacement
        Route::put('/{id}', [MaterialReplacementController::class, 'update']); // Update a material replacement
        Route::delete('/{id}', [MaterialReplacementController::class, 'destroy']); // Delete a material replacement
    });


    Route::prefix('photos')->group(function () {
        Route::get('/', [PhotoController::class, 'index']); // Fetch all photos
        Route::post('/', [PhotoController::class, 'store']); // Upload a photo
        Route::put('/{id}', [PhotoController::class, 'update']); // Update photo details
        Route::delete('/{id}', [PhotoController::class, 'destroy']); // Delete a photo
    });


});



require __DIR__.'/auth.php';
