<?php

namespace App\Http\Controllers;
use App\Models\ModelFaswil;
use App\Models\ModelSPMI;
use App\Models\ModelPtFaswil;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ControllerPtFaswil extends Controller
{
    public function pt_faswil(){
        $groupedData = $this->get_pt_faswil();
        return view('faswil', compact('groupedData'));
    }

    public function get_pt_faswil(){
        $data_faswil = ModelFaswil::pluck('nama_faswil', 'kode_faswil')->toArray();
        $data_pt = ModelPtFaswil::whereIn('kode_faswil', array_keys($data_faswil))->with('pt')->get();
        
        $groupedData = [];
        
        foreach ($data_pt as $item) {
            // Memastikan bahwa kode_faswil sudah ada dalam $groupedData
            if (!isset($groupedData[$item->kode_faswil])) {
                $groupedData[$item->kode_faswil] = [
                    'kode_faswil' => $item->kode_faswil,
                    'nama_faswil' => $data_faswil[$item->kode_faswil], // Mengambil nama_faswil berdasarkan kode_faswil
                    'pt' => [] // Inisialisasi array untuk PT
                ];
            }
        
            // Menambahkan data PT ke dalam array 'pt'
            $groupedData[$item->kode_faswil]['pt'][] = [
                'kode_pt' => $item->kodept,
                'nama_pt' => $item->pt->ptspmi // Mengambil nama_pt dari relasi pt
            ];
        }
        return $groupedData;
    }

    public function admin_get_pt_faswil(){
        $groupedData = $this->get_pt_faswil();
        return view('faswil_admin', compact('groupedData'));
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
            // Check if the kodept already exists in the database
            $existingPt = ModelPtFaswil::where('kodept', $pt)->first();
    
            if ($existingPt) {
                // If the kodept exists, skip the insert and notify the user
                return redirect()->back()->with('error', 'Kode PT ' . $pt . ' sudah terdaftar!');
            }
    
            // If the kodept does not exist, proceed to insert
            ModelPtFaswil::create([
                'kode_faswil' => $request->kode_faswil,
                'kodept' => $pt,
            ]);
        }
    
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
    public function destroy_faswil($kodept)
    {
        // Attempt to find the record with the given kode_pt
        $ptFaswil = ModelPtFaswil::where('kodept', $kodept)->first();
    
        // If the record is found, delete it
        if ($ptFaswil) {
            $ptFaswil->delete();
            return redirect()->back()->with('success', 'PT berhasil dihapus');
        }
    
        // If no record is found, return a not found message
        return redirect()->back()->with('error', 'PT tidak ada');
    }
    
}
