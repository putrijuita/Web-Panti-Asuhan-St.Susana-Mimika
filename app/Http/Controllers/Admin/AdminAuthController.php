<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        if (session()->has('admin_authenticated')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = config('admin.email');
        $password = config('admin.password');

        if ($request->email !== $email || $request->password !== $password) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
            ]);
        }

        session([
            'admin_authenticated' => true,
            'admin_email' => $email,
        ]);

        if ($request->boolean('remember')) {
            session()->put('admin_remember', true);
        }

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $request)
    {
        session()->forget(['admin_authenticated', 'admin_email', 'admin_remember']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
