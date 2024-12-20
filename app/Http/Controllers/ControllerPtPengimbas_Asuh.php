<?php

namespace App\Http\Controllers;
use App\Models\ModelSPMI;
use App\Models\ModelPtPengimbas_Asuh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\DB;

class ControllerPtPengimbas_Asuh extends Controller
{
    public function getPtPengimbas() {
        $pt_pengimbas = ModelSPMI::whereIn('kodept', ['042002', '041027', '041007', '041002', '041006', '041034', '041008', '041057', '041004', '041041'])
                        ->select('kodept', 'ptspmi')
                        ->get()
                        ->toArray();
        //unikom, itenas, unisba, marnat, unpar, widyatama, unpas, tel-u, pakuan, presiden
        $pt_asuh = ModelSPMI::whereNotIn('kodept', ['042002', '041027', '041007', '041002', '041006', '041034', '041008', '041057', '041004', '041041'])
                        ->select('kodept', 'ptspmi')
                        ->get()
                        ->toArray();
        return [
            'pt_pengimbas'=>$pt_pengimbas, 
            'pt_asuh'=> $pt_asuh
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

        return view('pt_pengimbas', compact('data'));
    }

    public function admin_pt_pengimbas(){
        $data = ModelPtPengimbas_Asuh::with(['pengimbas', 'asuh'])->get();

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
