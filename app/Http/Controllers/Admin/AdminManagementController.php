<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminCreatedNotification;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class AdminManagementController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $admins = Admin::query()
            ->when($search, fn ($q) => $q->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%"))
            ->orderByRaw("CASE role WHEN 'super_admin' THEN 0 WHEN 'admin' THEN 1 ELSE 2 END")
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.admins.index', compact('admins', 'search'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|string|min:4|confirmed',
            'role'     => 'required|in:super_admin,admin',
        ]);

        $plainPassword = $request->password;

        $admin = Admin::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($plainPassword),
            'role'     => $request->role,
        ]);

        // Kirim email notifikasi ke admin yang baru dibuat
        try {
            Mail::to($admin->email)->send(new AdminCreatedNotification($admin, $plainPassword));
        } catch (\Throwable $e) {
            // Biarkan pembuatan admin tetap berhasil meskipun email gagal dikirim
            report($e);
        }

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin berhasil ditambahkan dan notifikasi email telah dikirim.');
    }

    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'email', Rule::unique('admins')->ignore($admin->id)],
            'password' => 'nullable|string|min:4|confirmed',
            'role'     => 'required|in:super_admin,admin',
        ]);

        $currentAdmin = Auth::guard('admin')->user();

        // Prevent demoting yourself
        if ($currentAdmin->id === $admin->id && $request->role !== 'super_admin') {
            return back()->withErrors(['role' => 'Anda tidak dapat mengubah role akun Anda sendiri.']);
        }

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy(Admin $admin)
    {
        $currentAdmin = Auth::guard('admin')->user();

        if ($currentAdmin->id === $admin->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $admin->delete();

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin berhasil dihapus.');
    }
}
