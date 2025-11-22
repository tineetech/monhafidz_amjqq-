<?php

namespace App\Http\Controllers;

use App\Models\WaliSantri;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WaliController extends Controller
{
    /**
     * Menampilkan daftar wali santri.
     */
    public function index()
    {
        $wali = WaliSantri::with('santri')->get();
        return view('pages.master.wali.index', compact('wali'));
    }

    /**
     * Menampilkan form tambah wali santri.
     */
    public function create()
    {
        $santri = Santri::all();
        return view('pages.master.wali.create', compact('santri'));
    }

    /**
     * Menyimpan data wali santri baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'jenis_kelamin'  => 'required',
            'nik'            => 'required|string|max:20',
            'tanggal_lahir'  => 'required|date',
            'wali_sebagai'   => 'required|string',
            'santri_id'      => 'required|exists:santri,id',
            'alamat_lengkap' => 'required|string',
            'no_hp'          => 'required|string|max:15',
            'status_wali'    => 'required|string',
        ]);

        $wali = WaliSantri::create($request->all());
        
        if ($wali) {
            $firstName = Str::before($wali->nama_lengkap, ' ');
            
            if (empty($firstName)) {
                $firstName = $wali->nama_lengkap;
            }

            $baseUsername = Str::lower($firstName);
            
            $baseEmail = $baseUsername;

            $username = $baseUsername;
            $email = $baseEmail . '@gmail.com'; // Default email, akan dicek di bawah

            $i = 1;
            while (User::where('username', $username)->exists()) {
                $username = $baseUsername . $i;
                $i++;
            }

            do {
                $randomDigits = str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT); // 3 digit random
                $email = $baseEmail . $randomDigits . '@gmail.com';
            } while (User::where('email', $email)->exists());

            $user = User::create([
                'name'      => $wali->nama_lengkap,
                'username'  => $username, // Username yang sudah unik
                'email'     => $email,    // Email yang sudah unik
                'role'      => 'walisantri',
                'status'    => 'aktif',
                'password'  => Hash::make('wali123'), 
            ]);
            
            $wali->update(['user_id' => $user->id]);
        }

        return redirect()->route('wali.index')->with('success', 'Data wali wali berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit wali santri.
     */
    public function edit(string $id)
    {
        $wali = WaliSantri::findOrFail($id);
        $santri = Santri::all();
        return view('pages.master.wali.edit', compact('wali', 'santri'));
    }

    /**
     * Mengupdate data wali santri.
     */
    public function update(Request $request, string $id)
    {
        $wali = WaliSantri::findOrFail($id);

        $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'jenis_kelamin'  => 'required',
            'nik'            => 'required|string|max:20',
            'tanggal_lahir'  => 'required|date',
            'wali_sebagai'   => 'required|string',
            'santri_id'      => 'required|exists:santri,id',
            'alamat_lengkap' => 'required|string',
            'no_hp'          => 'required|string|max:15',
            'status_wali'    => 'required|string',
        ]);

        $wali->update($request->all());

        return redirect()->route('wali.index')->with('success', 'Data wali santri berhasil diperbarui.');
    }

    /**
     * Menghapus data wali santri.
     */
    public function destroy(string $id)
    {
        $wali = WaliSantri::findOrFail($id);
        $wali->delete();

        return redirect()->route('wali.index')->with('success', 'Data wali santri berhasil dihapus.');
    }
}
