<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login untuk admin dan user
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Coba login sebagai admin terlebih dahulu
        $admin = Admin::where('email', $request->email)->first();

        // dd($admin);
        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard')->with('success', 'Login sebagai Admin berhasil');
        }

        // Jika bukan admin, coba login sebagai user
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::guard('web')->login($user);
            return redirect()->route('dashboard')->with('success', 'Login sebagai User berhasil');
        }

        // Jika gagal login
        return back()->withErrors([
            'Email' => 'Email atau password salah',
        ])->withInput();
    }

    // Proses logout untuk admin dan user
    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect()->route('login')->with('success', 'Anda telah logout sebagai Admin');
        }

        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
            return redirect()->route('login')->with('success', 'Anda telah logout sebagai User');
        }

        return redirect()->route('login');
    }
}
