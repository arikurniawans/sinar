<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\Pegawai2Controller;
use App\Http\Controllers\MasterWismaController;
use App\Http\Controllers\MasterKasusController;
use App\Http\Controllers\MasterNomorController;
use App\Http\Controllers\DatabinaanController;
use App\Models\Employee;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/pegawai-tetap', [PegawaiController::class, 'index'])->name('pegawai.index')->middleware('auth');
Route::get('/pegawai-tetap/add', [PegawaiController::class, 'add'])->name('pegawai.add')->middleware('auth');
Route::post('/pegawai-tetap/store', [PegawaiController::class, 'store'])->name('pegawai.store')->middleware('auth');
Route::get('/pegawai-tetap/{id}', [PegawaiController::class, 'show'])->name('pegawai.show');
Route::get('/pegawai-tetap/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
Route::put('/pegawai-tetap/{id}/update', [PegawaiController::class, 'update'])->name('pegawai.update')->middleware('auth');
Route::delete('/pegawai-tetap/destroy/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy')->middleware('auth');

Route::get('/pegawai-tidak-tetap', [Pegawai2Controller::class, 'index'])->name('pegawai2.index')->middleware('auth');
Route::get('/pegawai-tidak-tetap/add', [Pegawai2Controller::class, 'add'])->name('pegawai2.add')->middleware('auth');
Route::post('/pegawai-tidak-tetap/store', [Pegawai2Controller::class, 'store'])->name('pegawai2.store')->middleware('auth');
Route::get('/pegawai-tidak-tetap/{id}', [Pegawai2Controller::class, 'show'])->name('pegawai2.show');
Route::get('/pegawai-tidak-tetap/edit/{id}', [Pegawai2Controller::class, 'edit'])->name('pegawai2.edit');
Route::put('/pegawai-tidak-tetap/{id}/update', [Pegawai2Controller::class, 'update'])->name('pegawai2.update')->middleware('auth');
Route::delete('/pegawai-tidak-tetap/destroy/{id}', [Pegawai2Controller::class, 'destroy'])->name('pegawai2.destroy')->middleware('auth');

Route::get('/masterwisma', [MasterWismaController::class, 'index'])->name('masterwisma.index')->middleware('auth');
Route::get('/masterwisma/add', [MasterWismaController::class, 'add'])->name('masterwisma.add')->middleware('auth');
Route::post('/masterwisma/store', [MasterWismaController::class, 'store'])->name('masterwisma.store')->middleware('auth');
Route::post('/masterwisma/store2', [MasterWismaController::class, 'store2'])->name('masterwisma.store2')->middleware('auth');
Route::post('/masterwisma/store3', [MasterWismaController::class, 'store3'])->name('masterwisma.store3')->middleware('auth');
Route::get('/masterwisma/{id}', [MasterWismaController::class, 'show'])->name('masterwisma.show')->middleware('auth');
Route::get('/masterwisma/export-wisma/{id}', [MasterWismaController::class, 'exportexcel'])->name('masterwisma.exportexcel')->middleware('auth');
Route::get('/masterwisma/edit/{id}', [MasterWismaController::class, 'edit'])->name('masterwisma.edit')->middleware('auth');
Route::get('/masterwisma/inputpengurus/{id}', [MasterWismaController::class, 'addpengurus'])->name('masterwisma.addpengurus')->middleware('auth');
Route::put('/masterwisma/{id}/update', [MasterWismaController::class, 'update'])->name('masterwisma.update')->middleware('auth');
Route::put('/masterwisma/{id}/update3', [MasterWismaController::class, 'update3'])->name('masterwisma.update3')->middleware('auth');
Route::delete('/masterwisma/destroy/{id}', [MasterWismaController::class, 'destroy'])->name('masterwisma.destroy')->middleware('auth');
Route::delete('/masterwisma/destroy3/{id}', [MasterWismaController::class, 'destroy3'])->name('masterwisma.destroy3')->middleware('auth');
Route::delete('/masterwisma/inputpengurus/destroy2/{id}', [MasterWismaController::class, 'destroy2'])->name('masterwisma.destroy2')->middleware('auth');


Route::get('/masterkasus', [MasterKasusController::class, 'index'])->name('masterkasus.index')->middleware('auth');
Route::get('/masterkasus/add', [MasterKasusController::class, 'add'])->name('masterkasus.add')->middleware('auth');
Route::post('/masterkasus/store', [MasterKasusController::class, 'store'])->name('masterkasus.store')->middleware('auth');
Route::get('/masterkasus/{id}', [MasterKasusController::class, 'show'])->name('masterkasus.show');
Route::get('/masterkasus/edit/{id}', [MasterKasusController::class, 'edit'])->name('masterkasus.edit');
Route::put('/masterkasus/{id}/update', [MasterKasusController::class, 'update'])->name('masterkasus.update')->middleware('auth');
Route::delete('/masterkasus/destroy/{id}', [MasterKasusController::class, 'destroy'])->name('masterkasus.destroy')->middleware('auth');

Route::get('/masternomor', [MasterNomorController::class, 'index'])->name('masternomor.index')->middleware('auth');
Route::get('/masternomor/add', [MasterNomorController::class, 'add'])->name('masternomor.add')->middleware('auth');
Route::post('/masternomor/store', [MasterNomorController::class, 'store'])->name('masternomor.store')->middleware('auth');
Route::get('/masternomor/{id}', [MasterNomorController::class, 'show'])->name('masternomor.show');
Route::get('/masternomor/edit/{id}', [MasterNomorController::class, 'edit'])->name('masternomor.edit');
Route::put('/masternomor/{id}/update', [MasterNomorController::class, 'update'])->name('masternomor.update')->middleware('auth');
Route::delete('/masternomor/destroy/{id}', [MasterNomorController::class, 'destroy'])->name('masternomor.destroy')->middleware('auth');

Route::get('/databinaan', [DatabinaanController::class, 'index'])->name('databinaan.index')->middleware('auth');
Route::get('/databinaan/add', [DatabinaanController::class, 'add'])->name('databinaan.add')->middleware('auth');
Route::post('/databinaan/store', [DatabinaanController::class, 'store'])->name('databinaan.store')->middleware('auth');
Route::get('/databinaan/{id}', [DatabinaanController::class, 'show'])->name('databinaan.show');
Route::get('/databinaan/edit/{id}', [DatabinaanController::class, 'edit'])->name('databinaan.edit');
Route::put('/databinaan/{id}/update', [DatabinaanController::class, 'update'])->name('databinaan.update')->middleware('auth');
Route::delete('/databinaan/destroy/{id}', [DatabinaanController::class, 'destroy'])->name('databinaan.destroy')->middleware('auth');
Route::get('/databinaan/kabkota/{idprovinsi}', [DataBinaanController::class, 'kabkota'])->name('databinaan.kabkota');
Route::get('/databinaan/kecamatan/{idprovinsi}', [DataBinaanController::class, 'kecamatan'])->name('databinaan.kecamatan');
Route::get('/databinaan/kelurahan/{idprovinsi}', [DataBinaanController::class, 'kelurahan'])->name('databinaan.kelurahan');


Route::get('/masterwisma/pengurus/{id}', [MasterWismaController::class, 'getpengurus'])->name('masterwisma.pengurus');





