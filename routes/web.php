<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', Controllers\HomeController::class)->name('home');

Route::get('/dashboard', [Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/attendance', [Controllers\AttendanceController::class, 'index'])->name('presence.index');
    Route::get('/izin', [Controllers\AttendanceController::class, 'izinForm'])->name('presence.izin');
    Route::post('/izin', [Controllers\AttendanceController::class, 'submitIzin'])->name('presence.submit-izin');
    Route::post('/check-in', [Controllers\AttendanceController::class, 'clockIn'])->name('presence.clock-in');
    Route::post('/check-out', [Controllers\AttendanceController::class, 'clockOut'])->name('presence.clock-out');
   Route::get('/history-absence', [Controllers\AttendanceController::class, 'history'])
    ->name('history-absence');
});


require __DIR__.'/auth.php';
