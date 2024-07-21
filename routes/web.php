<?php

use App\Http\Controllers\DesaController;
use App\Http\Controllers\KepalaKeluargaController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\SmsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {

    Route::get('/send-sms', [SmsController::class, 'sendSms'])->name('send-sms');
    Route::get('/send-wa/{message}', [SmsController::class, 'sendWhatsapp'])->name('send-wa');

    // Route::post('/send-azure-message', [SmsController::class, 'sendAzureMessage'])->name('send-sms');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'kendaraan'], function () {
        Route::get('', [KendaraanController::class, 'index'])->name('kendaraan.index');
        Route::get('/create', [KendaraanController::class, 'create'])->name('kendaraan.create');
        // Route::post('/store', [KendaraanController::class, 'store'])->name('kendaraan.store');
        Route::get('/print', [KendaraanController::class, 'printAll'])->name('kendaraan.printAll');
        // Route::get('/print/{id}', [KendaraanController::class, 'print'])->name('kendaraan.print');
        // Route::get('/edit/{id}', [KendaraanController::class, 'edit'])->name('kendaraan.edit');
        // Route::post('/update/{id}', [KendaraanController::class, 'update'])->name('kendaraan.update');
        // Route::delete('/delete/{id}', [KendaraanController::class, 'destroy'])->name('kendaraan.delete');
    });

});

require __DIR__.'/auth.php';
