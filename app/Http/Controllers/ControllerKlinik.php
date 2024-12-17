<?php

namespace App\Http\Controllers;
use App\Models\ModelFaswil;
use App\Models\ModelSPMI;
use App\Models\ModelKlinik;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ControllerKlinik extends Controller
{
    public function data_klinik_spmi() {
        $data = ModelKlinik::all();

        foreach ($data as $item) {
            // Ambil nama_faswil berdasarkan kode_faswil
            $item->nama_faswil = DB::table('akademik.faswil') 
                ->where('kode_faswil', $item->kode_faswil) 
                ->value('nama_faswil'); 
            $item->nama_pt = DB::table('akademik.ptspmi') 
                ->where('kodept', $item->kodept) 
                ->value('ptspmi'); 
        }
        return $data;
    }

    public function klinik_spmi_create() {
        $data_pt = ModelSPMI::all();
        $data_faswil = ModelFaswil::all();
    
        return view('klinik_spmi_create', [
            'pt' => $data_pt,
            'faswil' => $data_faswil
        ]);
    }
    public function store(Request $request)
    {
        // Validasi data (opsional tapi sangat disarankan)
        $validated = $request->validate([
            'kode_faswil' => 'required|string',
            'kodept' => 'required|string',
            'tahap' => 'required|integer',
            'tanggal_klinik' => 'required|date',
            'progress' => 'required|string',
            'tanggal_unggah_doc' => 'nullable|date',
            'deskripsi_progress' => 'nullable|string',
            'hasil_evaluasi' => 'nullable|string',
            'deskripsi_evaluasi' => 'nullable|string',
        ]);
    
        // Simpan data ke database
        ModelKlinik::create($validated);
    
        // Redirect atau kembalikan respon
        return redirect()->route('klinik')->with('success', 'Data berhasil disimpan!');
    }

    public function edit(){
        
    }



    public function klinik_spmi() {
        $data = $this->data_klinik_spmi();
        
        return view('klinik_spmi_admin', [
            'data' => $data
        ]);
            
    }

    public function admin_klinik_spmi() {
        $data = $this->data_klinik_spmi();
        
        return view('klinik_spmi_admin', [
            'data' => $data
        ]);
    }
}
