<?php

use App\Models\ModelLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ControllerKlinik;
use App\Http\Controllers\ControllerPtFaswil;
use App\Http\Controllers\ControllerAdmin;
use App\Http\Controllers\ControllerSPMI;
use App\Http\Controllers\ControllerPtPengimbas_Asuh;
use App\Http\Middleware\AdminMiddleware;
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

Route::get('/klinik_spmi', [ControllerKlinik::class, 'klinik_spmi']);
Route::get('/admin/klinik_spmi', [ControllerKlinik::class, 'admin_klinik_spmi'])
        ->middleware(AdminMiddleware::class)
        ->name('klinik');
Route::get('/admin/klinik_spmi/edit', [ControllerKlinik::class, 'edit'])->middleware(AdminMiddleware::class);
Route::get('/admin/klinik_spmi/create', [ControllerKlinik::class, 'create'])->middleware(AdminMiddleware::class);
Route::post('admin/klinik_spmi', [ControllerKlinik::class, 'store'])
        ->middleware(AdminMiddleware::class)
        ->name('klinik.store');

Route::get('/fasilitator_wilayah', [ControllerPtFaswil::class, 'pt_faswil']);
Route::get('/data/fasilitator_wilayah', [ControllerPtFaswil::class, 'get_pt_faswil']);
Route::get('/admin/fasilitator_wilayah', [ControllerPtFaswil::class, 'admin_get_pt_faswil'])
        ->middleware(AdminMiddleware::class)->name('faswil');
Route::get('/admin/fasilitator_wilayah/create', [ControllerPtFaswil::class, 'create_pt_faswil'])
        ->middleware(AdminMiddleware::class);
Route::delete('/admin/fasilitator_wilayah/delete/{kodept}', [ControllerPtFaswil::class, 'destroy_faswil'])
        ->middleware(AdminMiddleware::class)
        ->name('delete_faswil');
    
Route::post('/admin/fasilitator_wilayah', [ControllerPtFaswil::class, 'store'])->name('ptfaswil.store')->middleware(AdminMiddleware::class);

Route::get('/detail/{pt}', [ControllerSPMI::class, 'show'])->name('detail');
Route::get('/direktori_pts', [ControllerSPMI::class, 'show_pt']);

Route::get('/pt_pengimbas', [ControllerPtPengimbas_Asuh::class, 'pt_pengimbas']);
Route::get('data/pt_pengimbas', [ControllerPtPengimbas_Asuh::class, 'getPtPengimbas']);
Route::get('/admin/pt_pengimbas', [ControllerPtPengimbas_Asuh::class, 'admin_pt_pengimbas'])->middleware(AdminMiddleware::class)->name('pt_pengimbas');
Route::get('/admin/pt_pengimbas/create', [ControllerPtPengimbas_Asuh::class, 'create'])->middleware(AdminMiddleware::class);
Route::post('/admin/pt_pengimbas', [ControllerPtPengimbas_Asuh::class, 'store'])->middleware(AdminMiddleware::class)->name('pt_pengimbas.store');
Route::delete('/admin/pt_pengimbas/delete/{kode_pt_asuh}', [ControllerPtPengimbas_Asuh::class, 'destroy_pt_asuh'])
        ->middleware(AdminMiddleware::class)
        ->name('delete_pt_asuh');

Route::get('/api_pt', [ControllerSPMI::class, 'get_api_pt']);


