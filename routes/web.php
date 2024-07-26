<?php

use App\Http\Controllers\{
    BelanjaController,
    HomeController,
    ProfileController,
    KendaraanController,
    MaintenanceController,
    SmsController
};
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/send-sms', [SmsController::class, 'sendSms'])->name('send-sms');
    Route::get('/send-wa/{message}', [SmsController::class, 'sendWhatsapp'])->name('send-wa');

    Route::prefix('profile')->group(function () {
        Route::get('', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::prefix('kendaraan')->group(function () {
        Route::get('', [KendaraanController::class, 'index'])->name('kendaraan.index');
        Route::get('/create', [KendaraanController::class, 'create'])->name('kendaraan.create');
        Route::post('/store', [KendaraanController::class, 'store'])->name('kendaraan.store');
        Route::get('/print', [KendaraanController::class, 'printAll'])->name('kendaraan.printAll');
        Route::get('/edit/{id}', [KendaraanController::class, 'edit'])->name('kendaraan.edit');
        Route::post('/update/{id}', [KendaraanController::class, 'update'])->name('kendaraan.update');
        Route::delete('/delete/{id}', [KendaraanController::class, 'destroy'])->name('kendaraan.delete');
    });

    Route::prefix('maintenance')->group(function () {
        Route::get('', [MaintenanceController::class, 'index'])->name('maintenance.index');
        Route::get('/get-belanja-details/{nomor_registrasi}', [MaintenanceController::class, 'getBelanjaDetails'])->name('get.belanja.details');
    });

    Route::prefix('belanja')->group(function () {
        Route::get('', [BelanjaController::class, 'index'])->name('belanja.index');
        Route::get('/create', [BelanjaController::class, 'create'])->name('belanja.create');
        Route::post('/store', [BelanjaController::class, 'store'])->name('belanja.store');
        Route::delete('/delete/{id}', [BelanjaController::class, 'destroy'])->name('belanja.delete');
    });
});

require __DIR__.'/auth.php';
