<?php

namespace App\Http\Controllers;

use App\Models\ModelAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ControllerAdmin extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $admins = ModelAdmin::all();
        return view('admin.index', compact('admins'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('admin.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);
    
        // Buat instance admin baru
        $admin = new ModelAdmin();
        $admin->username = $request->username;
        $admin->password = bcrypt($request->password); // Pastikan password dienkripsi
        $admin->save();
    
        // Simpan informasi admin ke dalam session
        session(['admin_id' => $admin->id, 'admin_username' => $admin->username]);
    
        // Redirect dengan pesan sukses
        return redirect()->route('home')->with('success', 'Admin created successfully!');
    }

    // Display the specified resource
    public function show(ModelAdmin $admin)
    {
        return view('admin.show', compact('admin'));
    }

    // Show the form for editing the specified resource
    public function edit(ModelAdmin $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    // Update the specified resource in storage
    public function update(Request $request, ModelAdmin $admin)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:admins,username,' . $admin->id,
            'password' => 'nullable|string|min:8',
        ]);

        $admin->username = $request->username;
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();

        return redirect()->route('admin.index')->with('success', 'Admin updated successfully!');
    }

    // Remove the specified resource from storage
    public function destroy(ModelAdmin $admin)
    {
        $admin->delete();
        return redirect()->route('admin.index')->with('success', 'Admin deleted successfully!');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Mencari admin berdasarkan username
        $admin = ModelAdmin::where('username', $request->username)->first();

        // Memeriksa apakah admin ada dan password cocok
        if ($admin && password_verify($request->password, $admin->password)) {
            // Simpan informasi admin ke dalam session
            session(['admin_id' => $admin->id, 'admin_username' => $admin->username]);

            // Redirect ke halaman index atau halaman lain
            return redirect()->route('home')->with('success', 'Login successful!');
        }

        // Jika login gagal
        return redirect()->back()->with('error', 'Username atau Password salah')->withInput();
    }

    public function logout()
    {
        Auth::logout();
        session()->flush(); // Menghapus semua session
        return redirect('/')->with('success', 'Logged out successfully!');
    }
}
