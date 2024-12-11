<?php

use App\Models\ModelLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ControllerFaswil;
use App\Http\Controllers\ControllerAdmin;
use App\Http\Controllers\ControllerSPMI;
use Illuminate\Support\Facades\Route;

Route::get('/admin/create', [ControllerAdmin::class, 'create'])->name('admin.create');
Route::post('/admin/create', [ControllerAdmin::class, 'store'])->name('admin.store');
Route::get('/login', [ControllerAdmin::class, 'showLoginForm'])->name('login');
Route::post('/login', [ControllerAdmin::class, 'login']);
Route::post('/logout', [ControllerAdmin::class, 'logout'])->name('logout');
Route::get('/', [ControllerSPMI::class, 'index'])->name('home');
Route::get('/spmi_pt', [ControllerSPMI::class, 'spmi_pt']);
Route::get('/spmi_ppep', [ControllerSPMI::class, 'spmi_ppep']);
Route::get('/klasterisasi', [ControllerSPMI::class, 'klaster']);
Route::get('/data', [ControllerSPMI::class, 'ambilData']);
Route::get('/total_baris', [ControllerSPMI::class, 'calculate']);
Route::get('/total_semua', [ControllerSPMI::class, 'calculateAll']);
Route::get('/contoh_tabel', [ControllerSPMI::class, 'contoh']);
Route::get('/fasilitator_wilayah', [ControllerFaswil::class, 'get_pt_faswil']);
Route::get('/klinik_spmi', [ControllerFaswil::class, 'klinik_spmi']);
Route::get('/klinik_spmi/tambah', [ControllerFaswil::class, 'klinik_spmi_create']);
Route::get('/admin/fasilitator_wilayah', [ControllerFaswil::class, 'admin_get_pt_faswil']);
Route::get('/detail/{pt}', [ControllerSPMI::class, 'show'])->name('detail');
Route::get('/direktori_pts', [ControllerSPMI::class, 'show_pt']);
Route::get('/pt_pengimbas', [ControllerSPMI::class, 'pt_pengimbas']);
Route::get('/pt_pengimbas_create', [ControllerSPMI::class, 'pt_pengimbas_create']);
Route::get('/api_pt', [ControllerSPMI::class, 'get_api_pt']);

