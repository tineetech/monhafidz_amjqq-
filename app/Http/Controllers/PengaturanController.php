<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PengaturanController extends Controller
{
    /**
     * Tampilkan form pengaturan akun pengguna yang sedang login.
     */
    public function index()
    {
        $user = Auth::user();
        return view('pages.pengaturan.index', compact('user'));
    }

    /**
     * Update data akun pengguna yang sedang login.
     */
    public function update(Request $request, string $id = null)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string',
            'password' => 'nullable|string|min:6|confirmed',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if ($request->hasFile('foto')) {

            if ($user->foto && file_exists(public_path('storage/users/' . $user->foto))) {
                unlink(public_path('storage/users/' . $user->foto));
            }

            $filename = time() . '_' . $request->foto->getClientOriginalName();
            $request->foto->move(public_path('storage/users'), $filename);

            // Update ke database
            $user->foto = $filename;
        }

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('pengaturan.index')->with('success', 'Pengaturan akun berhasil diperbarui.');
    }

    // resource method lain tidak dipakai untuk fitur ini:
    public function create() {}
    public function store(Request $request) {}
    public function show(string $id) {}
    public function edit(string $id) {}
    public function destroy(string $id) {}
}