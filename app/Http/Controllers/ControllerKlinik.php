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
        $data_klinik = ModelKlinik::all();
        $data_pt = ModelSPMI::where('tutup', '=', null)->get();
        $data_faswil = ModelFaswil::all(); // Ambil data Faswil

        foreach ($data_klinik as $item) {
            // Ambil nama_faswil berdasarkan kode_faswil
            $item->nama_faswil = DB::table('akademik.faswil') 
                ->where('kode_faswil', $item->kode_faswil) 
                ->value('nama_faswil'); 
            $item->nama_pt = DB::table('akademik.ptspmi') 
                ->where('kodept', $item->kodept) 
                ->value('ptspmi'); 
        }

        return [
            'data_klinik'=>$data_klinik, 
            'data_faswil'=>$data_faswil, 
            'data_pt'=>$data_pt
        ];
    }

    public function create() {
        $data_pt = ModelSPMI::where('tutup', '=', null)->get();
        $data_faswil = ModelFaswil::all(); // Ambil data Faswil
    
        return view('klinik_spmi_create', compact('data_pt', 'data_faswil')); // Pastikan variabel dikirim
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

    public function edit($kode)
    {
        // Retrieve the existing record from the database by its ID
        $data = ModelKlinik::findOrFail($kode);
        $data_pt = ModelSPMI::where('tutup', '=', null)->get();
        $data_faswil = ModelFaswil::all(); // Ambil data Faswil
        
    
        // Return the view with the existing data to pre-fill the form
        // return [
        //     'data_klinik' => $data, 
        //     'data_pt' => $data_pt, 
        //     'data_faswil' => $data_faswil
        // ];
        return view('klinik_spmi_edit',compact('data_pt', 'data_faswil', 'data'));
    }
    
    public function update(Request $request, $kode)
    {
        // Validate the incoming data (same as in the store method)
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
        
        // Find the existing record and update it
        $klinik = ModelKlinik::findOrFail($kode);
        $klinik->update($validated);

        // Redirect or return response
        return redirect()->route('klinik')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy_klinik_spmi($kode){
        // Attempt to find the record with the given kode_pt
        $klinik = ModelKlinik::where('kode', $kode)->first();
        $klinik->delete();
        return redirect()->back()->with('success', 'Klinik berhasil dihapus');
    }

    public function klinik_spmi() {
        $data = $this->data_klinik_spmi();
        //return $data;
        return view('klinik_spmi', compact('data'));   
    }

    public function admin_klinik_spmi() {
        $data = $this->data_klinik_spmi();
        
        //return $data;
        return view('klinik_spmi_admin',compact('data'));
    }
}
