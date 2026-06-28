<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [], [
            'username' => 'Username',
            'password' => 'Password',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Role-based redirect
            if ($user->isAdmin()) {
                return redirect()->route('dashboard')->with('success', 'Selamat datang, ' . $user->name . '! Anda login sebagai Admin.');
            } else {
                return redirect()->route('dashboard')->with('success', 'Selamat datang, ' . $user->name . '!');
            }
        }

        return back()
            ->withErrors(['username' => 'Username atau password salah. Coba lagi.'])
            ->onlyInput('username');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda berhasil keluar.');
    }
}
