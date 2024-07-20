<?php

use App\Http\Controllers\DesaController;
use App\Http\Controllers\KepalaKeluargaController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermohonanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'permohonan'], function () {
        Route::get('', [PermohonanController::class, 'index'])->name('permohonan.index');
        Route::get('/create', [PermohonanController::class, 'create'])->name('permohonan.create');
        Route::post('/store', [PermohonanController::class, 'store'])->name('permohonan.store');
        Route::get('/print', [PermohonanController::class, 'printAll'])->name('permohonan.printAll');
        Route::get('/print/{id}', [PermohonanController::class, 'print'])->name('permohonan.print');
        Route::get('/edit/{id}', [PermohonanController::class, 'edit'])->name('permohonan.edit');
        Route::post('/update/{id}', [PermohonanController::class, 'update'])->name('permohonan.update');
        Route::delete('/delete/{id}', [PermohonanController::class, 'destroy'])->name('permohonan.delete');
    });

    Route::group(['prefix' => 'kepala_keluarga'], function () {
        Route::get('', [KepalaKeluargaController::class, 'index'])->name('kepala_keluarga.index');
        Route::get('/create', [KepalaKeluargaController::class, 'create'])->name('kepala_keluarga.create');
        Route::post('/store', [KepalaKeluargaController::class, 'store'])->name('kepala_keluarga.store');
        Route::get('/print', [KepalaKeluargaController::class, 'printAll'])->name('kepala_keluarga.printAll');
        Route::get('/print/{nkk}', [KepalaKeluargaController::class, 'print'])->name('kepala_keluarga.print');
        Route::get('/edit/{nkk}', [KepalaKeluargaController::class, 'edit'])->name('kepala_keluarga.edit');
        Route::post('/update/{nkk}', [KepalaKeluargaController::class, 'update'])->name('kepala_keluarga.update');
        Route::delete('/delete/{nkk}', [KepalaKeluargaController::class, 'destroy'])->name('kepala_keluarga.delete');
    });

    Route::group(['prefix' => 'penduduk'], function () {
        Route::get('', [PendudukController::class, 'index'])->name('penduduk.index');
        Route::get('/create', [PendudukController::class, 'create'])->name('penduduk.create');
        Route::post('/store', [PendudukController::class, 'store'])->name('penduduk.store');
        Route::get('/print', [PendudukController::class, 'printAll'])->name('penduduk.printAll');
        Route::get('/print/{nik}', [PendudukController::class, 'print'])->name('penduduk.print');
        Route::get('/edit/{nik}', [PendudukController::class, 'edit'])->name('penduduk.edit');
        Route::post('/update/{nik}', [PendudukController::class, 'update'])->name('penduduk.update');
        Route::delete('/delete/{nik}', [PendudukController::class, 'destroy'])->name('penduduk.delete');
    });

    Route::group(['prefix' => 'desa'], function () {
        Route::get('', [DesaController::class, 'index'])->name('desa.index');
        Route::put('/update/{kode_desa}', [DesaController::class, 'update'])->name('desa.update');
    });

});

require __DIR__.'/auth.php';
