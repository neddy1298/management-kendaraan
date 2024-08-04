<?php

use App\Http\Controllers\{
    AnggaranController,
    BelanjaController,
    GroupAnggaranController,
    HomeController,
    ProfileController,
    KendaraanController,
    MaintenanceController,
    MasterAnggaranController,
    SmsController,
    UnitKerjaController
};
use App\Models\GroupAnggaran;
use App\Models\MasterAnggaran;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->group(function () {

    Route::prefix('masterAnggaran')->group(function () {
        Route::get('', [MasterAnggaranController::class, 'index'])->name('masterAnggaran.index');
        Route::get('/create', [MasterAnggaranController::class, 'create'])->name('masterAnggaran.create');
        Route::post('/store', [MasterAnggaranController::class, 'store'])->name('masterAnggaran.store');
        Route::get('/edit/{id}', [MasterAnggaranController::class, 'edit'])->name('masterAnggaran.edit');
        Route::post('/update/{id}', [MasterAnggaranController::class, 'update'])->name('masterAnggaran.update');
        Route::delete('/delete/{id}', [MasterAnggaranController::class, 'destroy'])->name('masterAnggaran.delete');
    });

    Route::middleware(['check.master.anggaran'])->group(function () {
        Route::get('', [HomeController::class, 'index'])->name('home');

        Route::get('/send-sms', [SmsController::class, 'sendSms'])->name('send-sms');
        Route::get('/send-wa', [SmsController::class, 'sendWhatsapp'])->name('send-wa');
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
            Route::get('/get-belanja-details/{id}', [MaintenanceController::class, 'getBelanjaDetails'])->name('get.belanja.details');
            Route::get('', [MaintenanceController::class, 'exportToExcel'])->name('maintenance');
        });

        Route::prefix('belanja')->group(function () {
            Route::get('', [BelanjaController::class, 'index'])->name('belanja.index');
            Route::get('/create', [BelanjaController::class, 'create'])->name('belanja.create');
            Route::post('/store', [BelanjaController::class, 'store'])->name('belanja.store');
            Route::get('/print', [BelanjaController::class, 'printAll'])->name('belanja.printAll');
            Route::delete('/delete/{id}', [BelanjaController::class, 'destroy'])->name('belanja.delete');
        });

        Route::prefix('group')->group(function () {
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
        Route::prefix('groupAnggaran')->group(function () {
            Route::get('', [GroupAnggaranController::class, 'index'])->name('groupAnggaran.index');
            Route::get('/create', [GroupAnggaranController::class, 'create'])->name('groupAnggaran.create');
            Route::post('/store', [GroupAnggaranController::class, 'store'])->name('groupAnggaran.store');
            Route::get('/edit/{id}', [GroupAnggaranController::class, 'edit'])->name('groupAnggaran.edit');
            Route::post('/update/{id}', [GroupAnggaranController::class, 'update'])->name('groupAnggaran.update');
            Route::delete('/delete/{id}', [GroupAnggaranController::class, 'destroy'])->name('groupAnggaran.delete');
        });

        Route::prefix('profile')->group(function () {
            Route::get('', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::post('', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
    });
});

require __DIR__ . '/auth.php';
