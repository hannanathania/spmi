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

        if (strlen($request->password) < 8) {
            return back()->withErrors(['password' => 'Password minimal memiliki 8 karakter']);
        }
              
        // Buat instance admin baru
        $admin = new ModelAdmin();
        $admin->username = $request->username;
        $admin->password = bcrypt($request->password); // Pastikan password dienkripsi
        $admin->save();
    
        // Simpan informasi admin ke dalam session
        session(['admin_id' => $admin->id, 'admin_username' => $admin->username]);
    
        // Redirect dengan pesan sukses
        return redirect()->route('home')->with('success', 'Admin berhasil didaftarkan');
    }

    // Display the specified resource
    public function show(ModelAdmin $admin)
    {
        return view('admin.show', compact('admin'));
    }

    // Show the form for editing the specified resource
    public function edit()
    {
        $data = ModelAdmin::findOrFail(session('admin_id'));
        //return $data;
        return view('admin.profile', compact('data'));
    }

    // Update the specified resource in storage
    public function updateUsername(Request $request, $admin_id)
    {
        // Validasi input untuk username
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:admins,username,' . $admin_id,
        ]);
    
        // Cari admin berdasarkan ID
        $admin = ModelAdmin::findOrFail($admin_id);
        $admin->username = $validated['username'];
        $admin->save();
    
        return back()->with('success', 'Username berhasil diperbarui.');
    }

    public function updatePassword(Request $request, $admin_id)
{
    // Validasi input untuk password
    $validated = $request->validate([
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:8',
    ]);

    // Cari admin berdasarkan ID
    $admin = ModelAdmin::findOrFail($admin_id);

    // Verifikasi current password
    if (!Hash::check($validated['current_password'], $admin->password)) {
        return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
    }

    // Perbarui password
    $admin->password = Hash::make($validated['new_password']);
    $admin->save();

    return back()->with('success', 'Password berhasil diperbarui.');
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
