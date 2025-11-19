<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// BARIS 1: Impor trait yang diperlukan
use Illuminate\Foundation\Validation\ValidatesRequests;

class LoginController extends Controller
{
    // BARIS 2: Gunakan trait di dalam class
    use ValidatesRequests;

    /**
     * Menampilkan halaman/form login untuk admin.
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Memproses percobaan login dari admin.
     */
    public function login(Request $request)
    {
        // Baris ini sekarang akan berfungsi dengan benar
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard('admin')->attempt($credentials, $request->get('remember'))) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withInput($request->only('email', 'remember'))->withErrors(['email' => 'Email atau password salah.']);
    }

    /**
     * Melakukan logout untuk admin.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}