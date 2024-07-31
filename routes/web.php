<?php

use App\Http\Controllers\{
    AnggaranController,
    BelanjaController,
    HomeController,
    ProfileController,
    KendaraanController,
    MaintenanceController,
    SmsController,
    UnitKerjaController
};
use App\Models\GroupAnggaran;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(['check.master.anggaran'])->group(function () {
        Route::get('/anggaran', [AnggaranController::class, 'create'])->name('anggaran.create');
        Route::post('/anggaran', [AnggaranController::class, 'store'])->name('anggaran.store');
        Route::get('', [HomeController::class, 'index'])->name('home');

        Route::get('/send-sms', [SmsController::class, 'sendSms'])->name('send-sms');
        Route::get('/send-wa/{message}', [SmsController::class, 'sendWhatsapp'])->name('send-wa');

        Route::prefix('anggaran')->group(function () {
            Route::get('/edit', [AnggaranController::class, 'edit'])->name('anggaran.edit');
            Route::post('/update/{id}', [AnggaranController::class, 'update'])->name('anggaran.update');
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

        Route::frefix('group')->group(function (){
            Route::get('', [GroupAnggaran::class, 'index'])->name('group.index');
            Route::get('/create', [GroupAnggaran::class, 'create'])->name('group.create');
            Route::post('/store', [GroupAnggaran::class, 'store'])->name('group.store');
            Route::delete('/delete/{id}', [GroupAnggaran::class, 'destroy'])->name('group.delete');
        });

        Route::prefix('unitKerja')->group(function () {
            Route::get('', [UnitKerjaController::class, 'index'])->name('unitKerja.index');
            Route::get('/create', [UnitKerjaController::class, 'create'])->name('unitKerja.create');
            Route::post('/store', [UnitKerjaController::class, 'store'])->name('unitKerja.store');
            Route::get('/edit/{id}', [UnitKerjaController::class, 'edit'])->name('unitKerja.edit');
            Route::post('/update/{id}', [UnitKerjaController::class, 'update'])->name('unitKerja.update');
            Route::delete('/delete/{id}', [UnitKerjaController::class, 'destroy'])->name('unitKerja.delete');

            Route::get('/get-unitkerja-details/{id}', [UnitKerjaController::class, 'getUnitKerjaDetails'])->name('get.unitKerja.details');
        });
    
        Route::prefix('profile')->group(function () {
            Route::get('', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::post('', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
    });

});

require __DIR__ . '/auth.php';
