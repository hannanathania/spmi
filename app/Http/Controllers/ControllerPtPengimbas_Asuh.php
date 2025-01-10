<?php

namespace App\Http\Controllers;

use App\Models\ModelPtPengimbas;
use App\Models\ModelPtAsuh;
use App\Models\ModelSPMI;
use App\Models\ModelFaswil;
use App\Models\ModelPtPengimbas_Asuh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\DB;

class ControllerPtPengimbas_Asuh extends Controller
{
    public function getPtPengimbas() {
        $data_pengimbas = ModelPtPengimbas::all(); // Semua PT Pengimbas
        $data_asuh = ModelPtPengimbas_Asuh::with(['pengimbas', 'asuh'])->get();
        $spmiController = new ControllerSPMI();
        $data_SPMI = $spmiController->calculate(); // Data klaster
        
        // Membuat array untuk mencari klaster berdasarkan kodept
        $klaster_map = [];
        foreach ($data_SPMI as $item) {
            $klaster_map[$item['kode_pt']] = $item['klaster']; // Memetakan kodept ke klaster
        }
        
        // Inisialisasi groupedData
        $groupedData = [];
        
        // Tambahkan semua PT Pengimbas ke groupedData
        foreach ($data_pengimbas as $pt_pengimbas) {
            $kode_pt_peng = $pt_pengimbas->kodept;
        
            $groupedData[$kode_pt_peng] = [
                'kode_pt_peng' => $kode_pt_peng,
                'nama_pt_peng' => $pt_pengimbas->ptspmi,
                'klaster_pengimbas' => $klaster_map[$kode_pt_peng] ?? 'Tidak Dikenal', // Tentukan klaster PT Pengimbas
                'pt_asuh' => [] // Inisialisasi array untuk PT Asuh
            ];
        }
        
        // Tambahkan PT Asuh ke groupedData
        foreach ($data_asuh as $item) {
            $kode_pt_peng = $item->kode_pt_peng;
            $kode_pt_asuh = $item->kode_pt_asuh;
        
            // Pastikan bahwa PT Pengimbas sudah ada dalam groupedData
            if (!isset($groupedData[$kode_pt_peng])) {
                $groupedData[$kode_pt_peng] = [
                    'kode_pt_peng' => $kode_pt_peng,
                    'nama_pt_peng' => $item->pengimbas->ptspmi,
                    'klaster_pengimbas' => $klaster_map[$kode_pt_peng] ?? 'Tidak Dikenal',
                    'pt_asuh' => []
                ];
            }
        
            // Tambahkan data PT Asuh ke dalam array 'pt_asuh'
            $groupedData[$kode_pt_peng]['pt_asuh'][] = [
                'kode_pt_asuh' => $kode_pt_asuh,
                'nama_pt_asuh' => $item->asuh->ptspmi,
                'klaster_asuh' => $klaster_map[$kode_pt_asuh] ?? 'Tidak Dikenal'
            ];
        }
        
        // Mengembalikan data yang terstruktur
        return $groupedData;
    }

    public function create() {
        $pt_pengimbas = ModelPtPengimbas::all(); 
        $pt_asuh = ModelPtAsuh::all(); 
        return view ('penugasan_pengimbas_create', [
            'pt_pengimbas' => $pt_pengimbas,
            'pt_asuh' => $pt_asuh
        ]);
    }

    public function store(Request $request)
    {
        foreach ($request->kode_pt_asuh as $pt) {
            $existingPt = ModelPtPengimbas_Asuh::where('kode_pt_asuh', $pt)->first();
    
            if ($existingPt) {
                // If the kodept exists, skip the insert and notify the user
                return redirect()->back()->with('error', 'Kode PT ' . $pt . ' sudah terdaftar!');
            }

            ModelPtPengimbas_Asuh::create([
                'kode_pt_peng' => $request->kode_pt_pengimbas,
                'kode_pt_asuh' => $pt,
            ]);
        }
        Log::info('Request Data:', $request->all());
        return redirect()->route('pt_pengimbas')->with('success', 'Data berhasil disimpan!');
    }

    public function pt_pengimbas(){
        $data_pengimbas = ModelPtPengimbas::all(); // Semua PT Pengimbas
        $data_asuh = ModelPtPengimbas_Asuh::with(['pengimbas', 'asuh'])->get();
        $spmiController = new ControllerSPMI();
        $data_SPMI = $spmiController->calculate(); // Data klaster
        
        // Membuat array untuk mencari klaster berdasarkan kodept
        $klaster_map = [];
        foreach ($data_SPMI as $item) {
            $klaster_map[$item['kode_pt']] = $item['klaster']; // Memetakan kodept ke klaster
        }
        
        // Inisialisasi groupedData
        $groupedData = [];
        
        // Tambahkan semua PT Pengimbas ke groupedData
        foreach ($data_pengimbas as $pt_pengimbas) {
            $kode_pt_peng = $pt_pengimbas->kodept;
        
            $groupedData[$kode_pt_peng] = [
                'kode_pt_peng' => $kode_pt_peng,
                'nama_pt_peng' => $pt_pengimbas->ptspmi,
                'klaster_pengimbas' => $klaster_map[$kode_pt_peng] ?? 'Tidak Dikenal', // Tentukan klaster PT Pengimbas
                'pt_asuh' => [] // Inisialisasi array untuk PT Asuh
            ];
        }
        
        // Tambahkan PT Asuh ke groupedData
        foreach ($data_asuh as $item) {
            $kode_pt_peng = $item->kode_pt_peng;
            $kode_pt_asuh = $item->kode_pt_asuh;
        
            // Pastikan bahwa PT Pengimbas sudah ada dalam groupedData
            if (!isset($groupedData[$kode_pt_peng])) {
                $groupedData[$kode_pt_peng] = [
                    'kode_pt_peng' => $kode_pt_peng,
                    'nama_pt_peng' => $item->pengimbas->ptspmi,
                    'klaster_pengimbas' => $klaster_map[$kode_pt_peng] ?? 'Tidak Dikenal',
                    'pt_asuh' => []
                ];
            }
        
            // Tambahkan data PT Asuh ke dalam array 'pt_asuh'
            $groupedData[$kode_pt_peng]['pt_asuh'][] = [
                'kode_pt_asuh' => $kode_pt_asuh,
                'nama_pt_asuh' => $item->asuh->ptspmi,
                'klaster_asuh' => $klaster_map[$kode_pt_asuh] ?? 'Tidak Dikenal'
            ];
        }
        
        // Mengembalikan data yang terstruktur
        //return $groupedData;
        return view('pt_pengimbas', compact('groupedData'));        

    }

    public function admin_pt_pengimbas(){
        $data_pengimbas = ModelPtPengimbas::all(); // Semua PT Pengimbas
        $data_asuh = ModelPtPengimbas_Asuh::with(['pengimbas', 'asuh'])->get();
        $spmiController = new ControllerSPMI();
        $data_SPMI = $spmiController->calculate(); // Data klaster
        
        // Membuat array untuk mencari klaster berdasarkan kodept
        $klaster_map = [];
        foreach ($data_SPMI as $item) {
            $klaster_map[$item['kode_pt']] = $item['klaster']; // Memetakan kodept ke klaster
        }
        
        // Inisialisasi groupedData
        $groupedData = [];
        
        // Tambahkan semua PT Pengimbas ke groupedData
        foreach ($data_pengimbas as $pt_pengimbas) {
            $kode_pt_peng = $pt_pengimbas->kodept;
        
            $groupedData[$kode_pt_peng] = [
                'kode_pt_peng' => $kode_pt_peng,
                'nama_pt_peng' => $pt_pengimbas->ptspmi,
                'klaster_pengimbas' => $klaster_map[$kode_pt_peng] ?? 'Tidak Dikenal', // Tentukan klaster PT Pengimbas
                'pt_asuh' => [] // Inisialisasi array untuk PT Asuh
            ];
        }
        
        // Tambahkan PT Asuh ke groupedData
        foreach ($data_asuh as $item) {
            $kode_pt_peng = $item->kode_pt_peng;
            $kode_pt_asuh = $item->kode_pt_asuh;
        
            // Pastikan bahwa PT Pengimbas sudah ada dalam groupedData
            if (!isset($groupedData[$kode_pt_peng])) {
                $groupedData[$kode_pt_peng] = [
                    'kode_pt_peng' => $kode_pt_peng,
                    'nama_pt_peng' => $item->pengimbas->ptspmi,
                    'klaster_pengimbas' => $klaster_map[$kode_pt_peng] ?? 'Tidak Dikenal',
                    'pt_asuh' => []
                ];
            }
        
            // Tambahkan data PT Asuh ke dalam array 'pt_asuh'
            $groupedData[$kode_pt_peng]['pt_asuh'][] = [
                'kode_pt_asuh' => $kode_pt_asuh,
                'nama_pt_asuh' => $item->asuh->ptspmi,
                'klaster_asuh' => $klaster_map[$kode_pt_asuh] ?? 'Tidak Dikenal'
            ];
        }
        
        // Mengembalikan data yang terstruktur
        //return $groupedData;
        return view('pt_pengimbas_admin', compact('groupedData'));        

    }

    public function destroy_pt_asuh($kode_pt_asuh)
    {
        // Attempt to find the record with the given kode_pt
        $ptAsuh = ModelPtPengimbas_Asuh::where('kode_pt_asuh', $kode_pt_asuh)->first();
    
        // If the record is found, delete it
        if ($ptAsuh) {
            $ptAsuh->delete();
            return redirect()->back()->with('success', 'PT berhasil dihapus');
        }
    
        // If no record is found, return a not found message
        return redirect()->back()->with('error', 'PT tidak ada');
    }
    
}
