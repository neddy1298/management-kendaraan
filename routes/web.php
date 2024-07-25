<?php

use App\Http\Controllers\BelanjaController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KepalaKeluargaController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\SmsController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    Route::get('/send-sms', [SmsController::class, 'sendSms'])->name('send-sms');
    Route::get('/send-wa/{message}', [SmsController::class, 'sendWhatsapp'])->name('send-wa');

    // Route::post('/send-azure-message', [SmsController::class, 'sendAzureMessage'])->name('send-sms');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'kendaraan'], function () {
        Route::get('', [KendaraanController::class, 'index'])->name('kendaraan.index');
        Route::get('/create', [KendaraanController::class, 'create'])->name('kendaraan.create');
        Route::post('/store', [KendaraanController::class, 'store'])->name('kendaraan.store');
        Route::get('/print', [KendaraanController::class, 'printAll'])->name('kendaraan.printAll');
        // Route::get('/print/{id}', [KendaraanController::class, 'print'])->name('kendaraan.print');

        Route::get('/edit/{id}', [KendaraanController::class, 'edit'])->name('kendaraan.edit');
        Route::post('/update/{id}', [KendaraanController::class, 'update'])->name('kendaraan.update');
        Route::delete('/delete/{id}', [KendaraanController::class, 'destroy'])->name('kendaraan.delete');
    });

    Route::prefix('maintenance')->group(function () {
        Route::get('', [MaintenanceController::class, 'index'])->name('maintenance.index');
        Route::get('/edit/{id}', [MaintenanceController::class, 'edit'])->name('maintenance.edit');
        Route::post('/update/{id}', [MaintenanceController::class, 'update'])->name('maintenance.update');
        Route::delete('/delete/{id}', [MaintenanceController::class, 'destroy'])->name('maintenance.delete');
        Route::get('/get-belanja-details/{nomor_registrasi}', [MaintenanceController::class, 'getBelanjaDetails'])->name('get.belanja.details');
    });

    Route::prefix('belanja')->group(function () {
        Route::get('', [BelanjaController::class, 'index'])->name('belanja.index');
        Route::get('/create', [BelanjaController::class, 'create'])->name('belanja.create');
        Route::post('/store', [BelanjaController::class, 'store'])->name('belanja.store');
        Route::get('/edit/{id}', [BelanjaController::class, 'edit'])->name('belanja.edit');
        Route::post('/update/{id}', [BelanjaController::class, 'update'])->name('belanja.update');
        Route::delete('/delete/{id}', [BelanjaController::class, 'destroy'])->name('belanja.delete');

    });

});

require __DIR__.'/auth.php';
