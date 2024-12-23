<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelFaswil;
use App\Models\ModelSPMI;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class ControllerFaswil extends Controller {
    public function create(){
        $data_pt = ModelSPMI::where('tutup', '=', null)->get();
        return view('faswil_create', compact('data_pt'));
    }

    public function store(Request $request)
    {
        // Validasi input untuk kodept
        $validated = $request->validate([
            'kode_faswil' => 'required|string',
            'nama_faswil' => 'required|string',
            'kode_pt' => 'required|string',
            'nik'=>'nullable|string',
            'gelar_depan'=>'nullable|string',
            'gelar_blk'=>'nullable|string',
        ]);
    
        // Cek apakah kodept sudah terdaftar di ModelPtPengimbas
        $existingFaswil = ModelFaswil::where('nama_faswil', $validated['nama_faswil'])->first();
    
        if ($existingFaswil) {
            // Jika kodept sudah terdaftar, beri notifikasi error
            return redirect()->back()->withErrors(['nama_faswil' => 'Kode PT ' . $validated['nama_faswil'] . ' sudah terdaftar!']);
        }
    
        // Simpan data ke database dengan ptspmi dari tabel model_spmis
        ModelFaswil::create([
            'kode_faswil' => $validated['kode_faswil'],
            'nama_faswil' => $validated['nama_faswil'],
            'kode_pt' => $validated['kode_pt'],
            'nik' => $validated['nik'],
            'gelar_depan'=> $validated['gelar_depan'],
            'gelar_blk'=>$validated['gelar_blk']
        ]);
    
        // Redirect atau kembalikan respon sukses
        return redirect()->route('faswil')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($kode_faswil){
        $data = ModelFaswil::findOrFail($kode_faswil);
        $data_pt = ModelSPMI::where('tutup', '=', null)->get();
        return view('faswil_edit', compact('data','data_pt'));
    }

    public function update(Request $request, $kode_faswil){
        $validated = $request->validate([
            'kode_faswil' => 'required|string',
            'nama_faswil' => 'required|string',
            'kode_pt' => 'required|string',
            'nik'=>'nullable|string',
            'gelar_depan'=>'nullable|string',
            'gelar_blk'=>'nullable|string',
        ]);

        // Find the existing record and update it
        $klinik = ModelFaswil::findOrFail($kode_faswil);
        $klinik->update($validated);

        // Redirect or return response
        return redirect()->route('faswil')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy_faswil($kode_faswil){
        // Attempt to find the record with the given kode_pt
        $faswil = ModelFaswil::where('kode_faswil', $kode_faswil)->first();
        $faswil->delete();
        return redirect()->back()->with('success', 'Faswil berhasil dihapus');
    }
}
