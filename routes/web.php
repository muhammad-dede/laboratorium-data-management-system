<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JadwalPraktekController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MenuGuruController;
use App\Http\Controllers\MenuSiswaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', [BerandaController::class, 'index'])->name('beranda');

    Route::group(['prefix' => 'siswa', 'as' => 'siswa.', 'middleware' => 'menu_siswa'], function () {
        Route::group(['middleware' => 'register_siswa'], function () {
            Route::get('/beranda', [MenuSiswaController::class, 'beranda'])->name('beranda');
            Route::get('/jadwal', [MenuSiswaController::class, 'jadwal'])->name('jadwal.index');
            Route::get('/peminjaman', [MenuSiswaController::class, 'peminjaman'])->name('peminjaman.index');
            Route::get('/peminjaman/create', [MenuSiswaController::class, 'peminjaman_create'])->name('peminjaman.create');
            Route::get('/peminjaman/show/{peminjaman}', [MenuSiswaController::class, 'peminjaman_show'])->name('peminjaman.show');
            Route::put('/peminjaman/terima/{peminjaman}', [MenuSiswaController::class, 'peminjaman_terima'])->name('peminjaman.terima');
            Route::get('/riwayat', [MenuSiswaController::class, 'riwayat'])->name('riwayat.index');
            Route::get('/riwayat/show/{peminjaman}', [MenuSiswaController::class, 'riwayat_show'])->name('riwayat.show');
        });
        Route::group(['middleware' => 'unregister_siswa'], function () {
            Route::get('/profil', [MenuSiswaController::class, 'profil_create'])->name('profil');
            Route::post('/profil/store', [MenuSiswaController::class, 'profil_store'])->name('profil.store');
        });
    });

    Route::group(['prefix' => 'guru', 'as' => 'guru.', 'middleware' => 'menu_guru'], function () {
        Route::group(['middleware' => 'register_guru'], function () {
            Route::get('/beranda', [MenuGuruController::class, 'beranda'])->name('beranda');
            Route::get('/jadwal', [MenuGuruController::class, 'jadwal'])->name('jadwal.index');
            Route::get('/jadwal/show/{jadwal_praktek}', [MenuGuruController::class, 'jadwal_show'])->name('jadwal.show');
            Route::get('/peminjaman', [MenuGuruController::class, 'peminjaman'])->name('peminjaman.index');
            Route::get('/peminjaman/show/{peminjaman}', [MenuGuruController::class, 'peminjaman_show'])->name('peminjaman.show');
            Route::put('/peminjaman/acc/{peminjaman}', [MenuGuruController::class, 'peminjaman_acc'])->name('peminjaman.acc');
            Route::get('/riwayat', [MenuGuruController::class, 'riwayat'])->name('riwayat.index');
            Route::get('/riwayat/show/{peminjaman}', [MenuGuruController::class, 'riwayat_show'])->name('riwayat.show');
        });
        Route::group(['middleware' => 'unregister_guru'], function () {
            Route::get('/profil', [MenuGuruController::class, 'profil_create'])->name('profil');
            Route::post('/profil/store', [MenuGuruController::class, 'profil_store'])->name('profil.store');
        });
    });

    // Admin Dan Petugas
    Route::group(['middleware' => 'menu_admin'], function () {
        Route::resource('/petugas', PetugasController::class, ['except' => ['show', 'destroy']]);
        Route::resource('/kelas', KelasController::class, ['except' => ['show', 'destroy']]);
        Route::resource('/mapel', MapelController::class, ['except' => ['show', 'destroy']]);
    });
    Route::group(['middleware' => 'menu_petugas'], function () {
        Route::resource('/guru', GuruController::class, ['except' => ['show', 'destroy']]);
        Route::resource('/siswa', SiswaController::class, ['except' => ['show', 'destroy']]);
        Route::resource('/jadwal-praktek', JadwalPraktekController::class, ['except' => ['show', 'destroy']]);
        Route::resource('/rak', RakController::class, ['except' => ['show', 'destroy']]);
        Route::resource('/alat', AlatController::class, ['except' => ['destroy']]);
        Route::resource('/peminjaman', PeminjamanController::class, ['except' => ['destroy']]);
        Route::put('/peminjaman/update-status/{status}/{peminjaman}', [PeminjamanController::class, 'update_status'])->name('peminjaman.update_status');
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    });
});
