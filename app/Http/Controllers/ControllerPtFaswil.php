<?php

namespace App\Http\Controllers;
use App\Models\ModelFaswil;
use App\Models\ModelSPMI;
use App\Models\ModelPtFaswil;

use Illuminate\Http\Request;

class ControllerPtFaswil extends Controller
{
    public function pt_pengimbas(){
        $data = ModelPtFaswil::with(['pengimbas', 'asuh'])->get();

        return view('pt_pengimbas', compact('data'));
    }

    public function admin_pt_pengimbas(){
        $data = ModelPtFaswil::with(['pengimbas', 'asuh'])->get();

        return view('pt_pengimbas_admin', compact('data'));
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
