<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    public function edit()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.profile.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // max = kilobyte (Laravel). 1 GB = 1024 * 1024 KB
        $maxAvatarKb = 1024 * 1024;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:'.$maxAvatarKb],
            'remove_avatar' => ['nullable', 'boolean'],
            'current_password' => ['required_with:password', 'nullable', 'string'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if ($request->filled('password')) {
            if (! Hash::check($request->current_password, $admin->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.'])->withInput();
            }
        }

        $data = ['name' => $request->name];

        if ($request->hasFile('avatar')) {
            if ($admin->avatar) {
                Storage::disk('public')->delete($admin->avatar);
            }
            $path = $request->file('avatar')->store('admins/'.$admin->id, 'public');
            $data['avatar'] = $path;
        } elseif ($request->boolean('remove_avatar') && $admin->avatar) {
            Storage::disk('public')->delete($admin->avatar);
            $data['avatar'] = null;
        }

        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        $admin->update($data);

        return redirect()->route('admin.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
