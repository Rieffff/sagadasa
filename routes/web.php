<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
});

 
Route::get('/home', function(){return view('blank');})->name('dashboard');
Route::get('/report', function(){return view('report');})->name('report.index');
Route::get('/pdf', function(){return view('pdf');})->name('report.pdf');


Route::get('/daily-activity', function(){return view('daily-activity.index');})->name('daily-activity.index');
Route::get('/daily-report',function(){return view('daily-report.index');})->name('daily-report.index');
Route::get('generate-pdf', [PDFController::class, 'generatePDF'])->name('generate-pdf');


require __DIR__.'/auth.php';
