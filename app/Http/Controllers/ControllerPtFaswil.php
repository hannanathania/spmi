<?php

namespace App\Http\Controllers;
use App\Models\ModelFaswil;
use App\Models\ModelSPMI;
use App\Models\ModelPtFaswil;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ControllerPtFaswil extends Controller
{
    public function pt_faswil(){
        $data = ModelPtFaswil::with(['faswil', 'pt'])->get();

        return view('faswil', compact('data'));
    }

    public function admin_get_pt_faswil(){
        $data = ModelPtFaswil::with(['faswil', 'pt'])->get();

        return view('faswil_admin', compact('data'));
    }

    public function create_pt_faswil()
    {
        $data_pt = ModelSPMI::all();
        $data_faswil = ModelFaswil::all();
        return view('faswil_create' , [
            'pt' => $data_pt,
            'faswil' => $data_faswil
        ]); // Tampilkan form tambah
    }

    // Form untuk menambahkan data (CREATE)
    public function create_faswil()
    {
        return view('faswil_create'); // Tampilkan form tambah
    }

    // Menyimpan data baru (STORE)
    public function store(Request $request)
    {
        foreach ($request->kodept as $pt) {
            ModelPtFaswil::create([
                'kode_faswil' => $request->kode_faswil,
                'kodept' => $pt,
            ]);
        }

        Log::info('Request Data:', $request->all());
        return redirect()->route('faswil')->with('success', 'Data berhasil disimpan!');
    }

    // Form untuk edit data (EDIT)
    public function edit_faswil($id)
    {
        $item = ModelPtFaswil::findOrFail($id); // Cari data berdasarkan ID
        return view('faswil.edit', compact('item')); // Tampilkan form edit
    }

    // Update data (UPDATE)
    public function update_faswil(Request $request, $kode)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'kode_faswil' => 'required|string',
            'kodept' => 'required|array', // Ensure 'kodept' is an array
        ]);
    
        // Find the record to update
        $item = ModelPtFaswil::findOrFail($kode);
    
        // Update the record's fields
        $item->update([
            'kode_faswil' => $validatedData['kode_faswil'],
        ]);
    
        // Delete existing related records if necessary
        ModelPtFaswil::where('kode_faswil', $item->kode_faswil)->delete();
    
        // Recreate related records for `kodept`
        foreach ($validatedData['kodept'] as $pt) {
            ModelPtFaswil::create([
                'kode_faswil' => $validatedData['kode_faswil'],
                'kodept' => $pt,
            ]);
        }
    
        // Redirect with a success message
        return redirect()->route('faswil')->with('success', 'Data berhasil diupdate!');
    }
    

    // Menghapus data (DELETE)
    public function destroy_faswil($kode)
    {
        $item = ModelFaswil::findOrFail($kode);
        $item->delete(); // Hapus data
        return redirect()->route('faswil')->with('success', 'Data berhasil dihapus!');
    }
}
