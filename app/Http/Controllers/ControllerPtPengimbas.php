<?php

namespace App\Http\Controllers;
use App\Models\ModelSPMI;
use App\Models\ModelPtPengimbas;
use Illuminate\Http\Request;

class ControllerPtPengimbas extends Controller
{
    public function create() {
        $data = ModelSPMI::where('tutup', '=', null)
        ->whereNotIn('kodept', ['041103', '041129', '041131'])
        ->get();
        return view ('pt_pengimbas_create', compact('data'));
    }

    public function store(Request $request)
    {
        // Validasi input untuk kodept
        $validated = $request->validate([
            'kodept' => 'required|string', // Pastikan kodept valid
        ]);
    
        $spmiData = ModelSPMI::where('kodept', $validated['kodept'])->first();
    
        if (!$spmiData) {
            // Jika tidak ditemukan, kembalikan pesan error
            return redirect()->back()->withErrors(['kodept' => 'Kode PT tidak valid atau tidak memiliki PT SPMI yang terkait.']);
        }
    
        // Cek apakah kodept sudah terdaftar di ModelPtPengimbas
        $existingPt = ModelPtPengimbas::where('kodept', $validated['kodept'])->first();
    
        if ($existingPt) {
            // Jika kodept sudah terdaftar, beri notifikasi error
            return redirect()->back()->withErrors(['kodept' => 'Kode PT ' . $validated['kodept'] . ' sudah terdaftar!']);
        }
    
        // Simpan data ke database dengan ptspmi dari tabel model_spmis
        ModelPtPengimbas::create([
            'kodept' => $validated['kodept'],
            'ptspmi' => $spmiData['ptspmi']
        ]);
    
        // Redirect atau kembalikan respon sukses
        return redirect()->route('pt_pengimbas')->with('success', 'Data berhasil disimpan!');
    }
    

    public function destroy_pt_pengimbas($kode_pt_peng)
    {
        // Attempt to find the record with the given kode_pt
        $ptAsuh = ModelPtPengimbas::where('kodept', $kode_pt_peng)->first();
    
        // If the record is found, delete it
        if ($ptAsuh) {
            $ptAsuh->delete();
            return redirect()->back()->with('success', 'PT berhasil dihapus');
        }
    
        // If no record is found, return a not found message
        return redirect()->back()->with('error', 'PT tidak ada');
    }

}
