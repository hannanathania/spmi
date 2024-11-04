<?php

use App\Http\Controllers\ControllerSPMI;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [ControllerSPMI::class, 'index']);
Route::get('/table', [ControllerSPMI::class, 'table']);
Route::get('/data', [ControllerSPMI::class, 'ambilData']);
Route::get('/total_baris', [ControllerSPMI::class, 'calculate']);
Route::get('/total_semua', [ControllerSPMI::class, 'calculateAll']);
Route::get('/pagination', [ControllerSPMI::class, 'paginate']);

