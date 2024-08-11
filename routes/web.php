<?php

use App\Http\Controllers\{
    BelanjaController,
    GroupAnggaranController,
    HomeController,
    ProfileController,
    KendaraanController,
    LaporanController,
    MasterAnggaranController,
    PaguAnggaranController,
    SmsController,
    StokSukuCadangController,
};
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->group(function () {

    Route::prefix('paguAnggaran')->group(function () {
        Route::get('', [PaguAnggaranController::class, 'index'])->name('paguAnggaran.index');
        Route::get('/create', [PaguAnggaranController::class, 'create'])->name('paguAnggaran.create');
        Route::post('/store', [PaguAnggaranController::class, 'store'])->name('paguAnggaran.store');
        Route::get('/edit/{id}', [PaguAnggaranController::class, 'edit'])->name('paguAnggaran.edit');
        Route::post('/update/{id}', [PaguAnggaranController::class, 'update'])->name('paguAnggaran.update');
        Route::delete('/delete/{id}', [PaguAnggaranController::class, 'destroy'])->name('paguAnggaran.delete');
    });
    Route::middleware(['check.pagu.anggaran'])->group(function () {

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

            Route::prefix('sukuCadang')->group(function () {
                Route::get('', [StokSukuCadangController::class, 'index'])->name('sukuCadang.index');
                Route::get('/create', [StokSukuCadangController::class, 'create'])->name('sukuCadang.create');
                Route::post('/store', [StokSukuCadangController::class, 'store'])->name('sukuCadang.store');
                Route::get('/edit/{id}', [StokSukuCadangController::class, 'edit'])->name('sukuCadang.edit');
                Route::post('/update/{id}', [StokSukuCadangController::class, 'update'])->name('sukuCadang.update');
                Route::delete('/delete/{id}', [StokSukuCadangController::class, 'destroy'])->name('sukuCadang.delete');
            });

            Route::prefix('laporan')->group(function () {
                Route::get('', [LaporanController::class, 'index'])->name('laporan.index');
                Route::get('/export-excel', [LaporanController::class, 'exportToExcel'])->name('laporan.exportExcel');
                Route::get('/print', [LaporanController::class, 'print'])->name('laporan.print');
            });

            Route::prefix('belanja')->group(function () {
                Route::get('', [BelanjaController::class, 'index'])->name('belanja.index');
                Route::get('/create', [BelanjaController::class, 'create'])->name('belanja.create');
                Route::post('/store', [BelanjaController::class, 'store'])->name('belanja.store');
                Route::get('/print', [BelanjaController::class, 'printAll'])->name('belanja.printAll');
                Route::delete('/delete/{id}', [BelanjaController::class, 'destroy'])->name('belanja.delete');
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

        // Route::get('/get-group-anggaran/{group_id}', [BelanjaController::class, 'getGroupAnggaran']);    
        Route::get('/get-kendaraan/{group_anggaran_id}', [BelanjaController::class, 'getKendaraan']);
    });
});

require __DIR__ . '/auth.php';
                