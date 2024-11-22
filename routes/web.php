<?php

use App\Http\Controllers\ControllerFaswil;
use App\Http\Controllers\ControllerSPMI;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [ControllerSPMI::class, 'index']);
Route::get('/klasterisasi', [ControllerSPMI::class, 'klaster']);
Route::get('/data', [ControllerSPMI::class, 'ambilData']);
Route::get('/total_baris', [ControllerSPMI::class, 'calculate']);
Route::get('/total_semua', [ControllerSPMI::class, 'calculateAll']);
Route::get('/contoh_tabel', [ControllerSPMI::class, 'contoh']);
Route::get('/fasilitator_wilayah', [ControllerFaswil::class, 'get_pt_faswil']);
Route::get('/admin/fasilitator_wilayah', [ControllerFaswil::class, 'get_pt_faswil']);
Route::get('/admin/fasilitator_wilayah/update', [ControllerFaswil::class, 'create_faswil']);
Route::get('/detail/{pt}', [ControllerSPMI::class, 'show'])->name('detail');

// Route::get('/pagination', [ControllerSPMI::class, 'paginate']);

