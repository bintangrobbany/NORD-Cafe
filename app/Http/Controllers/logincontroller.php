<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman register.
     */
    public function register()
    {
        return view('register');
    }

    /**
     * Memproses data dari formulir register.
     */
    public function postregister(Request $request)
    {
        // 1. Validasi Input
        // Memastikan semua input diisi sesuai aturan sebelum diproses.
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email:dns|unique:users', // 'unique:users' memastikan email belum terdaftar
            'password' => 'required|string|min:8|confirmed', // 'confirmed' akan mencocokkan dengan field 'password_confirmation'
        ]);

        // 2. Membuat Pengguna Baru
        // Jika validasi berhasil, buat entri baru di tabel 'users'.
        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password WAJIB di-hash demi keamanan!
        ]);

        // 3. Redirect ke Halaman Login
        // Arahkan pengguna ke halaman login dengan pesan sukses.
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Menampilkan halaman login.
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Memproses data dari formulir login.
     */
    public function postlogin(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        // 2. Proses Autentikasi
        // Mencoba untuk login pengguna dengan email dan password yang diberikan.
        if (Auth::attempt($credentials)) {
            // Jika berhasil, regenerate session untuk keamanan
            $request->session()->regenerate();
            
            // Redirect ke halaman index (untuk pengguna yang sudah login)
            return redirect()->intended('/index');
        }

        // 3. Jika Gagal
        // Kembali ke halaman login dengan pesan error.
        return back()->with('error', 'Login gagal! Email atau Password salah.');
    }

    /**
     * Memproses logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman utama (untuk pengunjung)
        return redirect('/');
    }
    
    /**
     * Menampilkan halaman dashboard/index setelah login.
     * Anda sudah punya ini di web.php, jadi kita tambahkan fungsinya di sini.
     */
    public function index()
    {
        return view('index');
    }
}