<?php

namespace App\Http\Controllers;

use App\Models\ModelPtPengimbas;
use App\Models\ModelPtAsuh;
use App\Models\ModelSPMI;
use App\Models\ModelPtPengimbas_Asuh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\DB;

class ControllerPtPengimbas_Asuh extends Controller
{
    public function getPtPengimbas() {
    
        // Mengambil data pt_pengimbas berdasarkan kodept yang ada
        $pt_pengimbas = ModelPtPengimbas::all();
        $pt_asuh = ModelPtAsuh::all();
        
    
        return [
            'pt_pengimbas' => $pt_pengimbas, 
            'pt_asuh' => $pt_asuh
        ];
    }
    

    public function create() {
        $data = $this->getPtPengimbas();
        return view ('pt_pengimbas_create', [
            'pt_pengimbas' => $data['pt_pengimbas'],
            'pt_asuh' => $data['pt_asuh']
        ]);
    }
    public function store(Request $request)
    {
        foreach ($request->kode_pt_asuh as $pt) {
            ModelPtPengimbas_Asuh::create([
                'kode_pt_peng' => $request->kode_pt_pengimbas,
                'kode_pt_asuh' => $pt,
            ]);
        }
        Log::info('Request Data:', $request->all());
        return redirect()->route('pt_pengimbas')->with('success', 'Data berhasil disimpan!');
    }

    public function pt_pengimbas(){
        $data = ModelPtPengimbas_Asuh::with(['pengimbas', 'asuh'])->get();
        $spmiController = new ControllerSPMI();
        $data_SPMI = $spmiController->calculate(); // Data klaster
    
        // Membuat array untuk mencari klaster berdasarkan kodept
        $klaster_map = [];
        foreach ($data_SPMI as $item) {
            $klaster_map[$item['kode_pt']] = $item['klaster']; // Memetakan kodept ke klaster
        }
    
        // Gabungkan data pengimbas dengan nilai klaster berdasarkan kodept
        foreach ($data as $pengimbas) {
            // Tentukan klaster untuk pengimbas berdasarkan kode_pt_peng
            $kode_pt_peng = $pengimbas->kode_pt_peng;
            $pengimbas->pengimbas->klaster = isset($klaster_map[$kode_pt_peng]) ? $klaster_map[$kode_pt_peng] : 'Tidak Dikenal';
    
            // Tentukan klaster untuk asuh berdasarkan kode_pt_asuh
            $kode_pt_asuh = $pengimbas->kode_pt_asuh;
            $pengimbas->asuh->klaster = isset($klaster_map[$kode_pt_asuh]) ? $klaster_map[$kode_pt_asuh] : 'Tidak Dikenal';
        }
    
        // Kembalikan data pengimbas dengan klaster yang sudah ditambahkan
        //return $data;
        return view('pt_pengimbas', compact('data'));
    }
    
    public function pt_pengimbas_detail($pt_pengimbas){
        $data = ModelPtPengimbas_Asuh::with(['pengimbas', 'asuh'])->get();
        return view('pt_pengimbas_detail', compact('data'));
    }

    public function admin_pt_pengimbas(){
        $data = ModelPtPengimbas_Asuh::with(['pengimbas', 'asuh'])->get();
        $spmiController = new ControllerSPMI();
        $data_SPMI = $spmiController->calculate(); // Data klaster
    
        // Membuat array untuk mencari klaster berdasarkan kodept
        $klaster_map = [];
        foreach ($data_SPMI as $item) {
            $klaster_map[$item['kode_pt']] = $item['klaster']; // Memetakan kodept ke klaster
        }
    
        // Gabungkan data pengimbas dengan nilai klaster berdasarkan kodept
        foreach ($data as $pengimbas) {
            // Tentukan klaster untuk pengimbas berdasarkan kode_pt_peng
            $kode_pt_peng = $pengimbas->kode_pt_peng;
            $pengimbas->pengimbas->klaster = isset($klaster_map[$kode_pt_peng]) ? $klaster_map[$kode_pt_peng] : 'Tidak Dikenal';
    
            // Tentukan klaster untuk asuh berdasarkan kode_pt_asuh
            $kode_pt_asuh = $pengimbas->kode_pt_asuh;
            $pengimbas->asuh->klaster = isset($klaster_map[$kode_pt_asuh]) ? $klaster_map[$kode_pt_asuh] : 'Tidak Dikenal';
        }
    
        // Kembalikan data pengimbas dengan klaster yang sudah ditambahkan
        //return $data;
        return view('pt_pengimbas_admin', compact('data'));
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
