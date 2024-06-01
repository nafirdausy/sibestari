<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\UserControlController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HasilPerhitunganController;
use App\Http\Controllers\PenerimaanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('auth');
    Route::post('/', [AuthController::class, 'login']);
});


Route::middleware(['auth'])->group(function () {
    Route::redirect('/home', '/user');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('userAkses:admin');
    Route::get('/user', [UserController::class, 'index'])->name('user')->middleware('userAkses:user');

    Route::get('/reset-password', [ResetPasswordController::class, 'showReset'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword']);

    Route::get('/profileadmin', [AdminController::class, 'profile']);
    Route::post('/profileadmin', [AdminController::class, 'profileedit']);

    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/profile', [UserController::class, 'profileedit']);

    Route::get('/datasiswa', [DataSiswaController::class, 'index'])->name('datasiswa');
    Route::get('/siswatambah', [DataSiswaController::class, 'tambah']);
    Route::get('/siswaedit/{id}', [DataSiswaController::class, 'edit']);
    Route::get('/siswadetail/{id}', [DataSiswaController::class, 'detail']);
    Route::post('/siswahapus/{id}', [DataSiswaController::class, 'hapus']);
    // new
    Route::post('/tambahsiswa', [DataSiswaController::class, 'create']);
    Route::post('/editsiswa', [DataSiswaController::class, 'change']);

    //ajukan
    Route::post('/ajukan/{id}', [DataSiswaController::class, 'ajukan'])->name('ajukan');
    Route::post('/datasiswa', [DataSiswaController::class, 'show'])->name('datasiswa.show');
    
    Route::get('/usercontrol', [UserControlController::class, 'index'])->name('usercontrol');
    Route::get('/tambahuc', [UserControlController::class, 'tambah']);
    Route::get('/edituc/{id}', [UserControlController::class, 'edit']);
    Route::get('/detailuc/{id}', [UserControlController::class, 'detail']);
    Route::post('/hapusuc/{id}', [UserControlController::class, 'hapus']);
    Route::post('/tambahuc', [UserControlController::class, 'create']);
    Route::post('/edituc', [UserControlController::class, 'change']);

    Route::get('/periode', [PeriodeController::class, 'index'])->name('periode');
    Route::get('/tambahperiode', [PeriodeController::class, 'tambah']);
    Route::get('/editperiode/{id}', [PeriodeController::class, 'edit']);
    Route::post('/hapusperiode/{id}', [PeriodeController::class, 'hapus']);
    Route::post('/tambahperiode', [PeriodeController::class, 'create']);
    Route::post('/editperiode', [PeriodeController::class, 'change']);

    Route::get('/hasil', [HasilPerhitunganController::class, 'index'])->name('hasil.index');
    Route::get('/create', [HasilPerhitunganController::class, 'create'])->name('hasil.create');
    Route::post('/store', [HasilPerhitunganController::class, 'store'])->name('hasil.store');
    Route::post('/penerimahapus/{id}', [HasilPerhitunganController::class, 'hapus'])->name('hasil.hapus');
    Route::post('/terima/{id}', [HasilPerhitunganController::class, 'terima'])->name('hasil.terima');
    Route::post('/hasil', [HasilPerhitunganController::class, 'showRiwayat'])->name('hasil.showRiwayat');

    Route::get('/penerima', [PenerimaanController::class, 'index'])->name('penerima');
    Route::post('/penerima', [PenerimaanController::class, 'showRiwayat'])->name('penerima.showRiwayat');
    Route::get('/cetak/{id_periode}', [PenerimaanController::class, 'cetak'])->name('penerima.cetak');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});
