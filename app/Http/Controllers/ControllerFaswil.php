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
    public function get_pt_faswil() {
        $data_pt_faswil = ModelSPMI::join('akademik.faswil', 'akademik.faswil.kode_faswil', '=', 'akademik.ptspmi.kode_faswil')
            ->select('akademik.ptspmi.kodept', 'akademik.ptspmi.ptspmi', 'akademik.ptspmi.kode_faswil', 'akademik.faswil.nama_faswil')
            ->get();
    
        return view('faswil', [
            'data' => $data_pt_faswil
        ]);
    }

    public function admin_get_pt_faswil() {
        $data_pt_faswil = ModelSPMI::join('akademik.faswil', 'akademik.faswil.kode_faswil', '=', 'akademik.ptspmi.kode_faswil')
            ->select('akademik.ptspmi.kodept', 'akademik.ptspmi.ptspmi', 'akademik.ptspmi.kode_faswil', 'akademik.faswil.nama_faswil')
            ->get();
    
        return view('faswil_admin', [
            'data' => $data_pt_faswil
        ]);
    }
    public function klinik_spmi() {
        $data_pt_faswil = ModelSPMI::join('akademik.faswil', 'akademik.faswil.kode_faswil', '=', 'akademik.ptspmi.kode_faswil')
            ->select('akademik.ptspmi.kodept', 'akademik.ptspmi.ptspmi', 'akademik.ptspmi.kode_faswil', 'akademik.faswil.nama_faswil')
            ->get();
    
        return view('klinik_spmi', [
            'data' => $data_pt_faswil
        ]);
    }

    public function klinik_spmi_create() {
        $data_pt = ModelSPMI::all();
        $data_faswil = ModelFaswil::all();

    
        return view('klinik_spmi_create', [
            'pt' => $data_pt,
            'faswil' => $data_faswil
        ]);
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
    public function store_faswil(Request $request)
    {
        $validatedData = $request->validate([
            'field1' => 'required',
            'field2' => 'required',
        ]);

        ModelFaswil::create($validatedData); // Simpan data
        return redirect()->route('faswil')->with('success', 'Data berhasil ditambahkan!');
    }

    // Form untuk edit data (EDIT)
    public function edit_faswil($id)
    {
        $item = ModelFaswil::findOrFail($id); // Cari data berdasarkan ID
        return view('faswil.edit', compact('item')); // Tampilkan form edit
    }

    // Update data (UPDATE)
    public function update_faswil(Request $request, $id)
    {
        $validatedData = $request->validate([
            'field1' => 'required',
            'field2' => 'required',
        ]);

        $item = ModelFaswil::findOrFail($id);
        $item->update($validatedData); // Update data
        return redirect()->route('faswil')->with('success', 'Data berhasil diupdate!');
    }

    // Menghapus data (DELETE)
    public function destroy_faswil($id)
    {
        $item = ModelFaswil::findOrFail($id);
        $item->delete(); // Hapus data
        return redirect()->route('faswil')->with('success', 'Data berhasil dihapus!');
    }
}
