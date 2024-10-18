<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogController;
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
    Route::get('/logs', [LogController::class, 'logData'])->name('log.logs');
    Route::get('/about', [LogController::class, 'about'])->name('log.about');
});

Route::get('/about', [LogController::class, 'about'])->name('log.about');
Route::get('/contact', [LogController::class, 'contact'])->name('log.contact');
Route::get('/logs', [LogController::class, 'logData'])->name('log.logs');

require __DIR__.'/auth.php';
