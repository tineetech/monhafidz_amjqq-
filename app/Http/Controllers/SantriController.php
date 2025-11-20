<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $santri = Santri::all();
        return view('pages.master.santri.index', compact('santri'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        $semesters = Semester::where('jenis_hafalan', 'ziyadah')->get();

        return view('pages.master.santri.create', compact('semesters'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string',
            'jenis_kelamin' => 'required',
            'nik' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat_lengkap' => 'required|string',
            'no_hp' => 'required|string',
            'semester_id' => 'required|integer',
            'total_juz_tercapai' => 'required|integer',
            'status_santri' => 'required|string',
            'foto'         => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $path = $image->hashName();
            $image->storeAs('santri', $path);
            $validated['foto'] = $path;
        }

        $santri = \App\Models\Santri::create($validated);

        if ($santri) {
            $firstName = Str::before($santri->nama_lengkap, ' ');
            
            if (empty($firstName)) {
                $firstName = $santri->nama_lengkap;
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
                'name'      => $santri->nama_lengkap,
                'username'  => $username, // Username yang sudah unik
                'email'     => $email,    // Email yang sudah unik
                'role'      => 'santri',
                'status'    => 'aktif',
                'password'  => Hash::make('santri123'), 
            ]);
            
            $santri->update(['user_id' => $user->id]);
        }

        return redirect()->route('santri.index')->with('success', 'Data santri berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $id)
    {
        $santri = \App\Models\Santri::findOrFail($id);
        $semesters = Semester::where('jenis_hafalan', 'ziyadah')->get();

        return view('pages.master.santri.edit', compact('santri', 'semesters'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string',
            'jenis_kelamin' => 'required',
            'nik' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat_lengkap' => 'required|string',
            'no_hp' => 'required|string',
            'semester_id' => 'required|integer',
            'total_juz_tercapai' => 'required|integer',
            'status_santri' => 'required|string',
            'foto'         => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $santri = \App\Models\Santri::findOrFail($id);
        if ($request->hasFile('foto')) {
            if ($santri->foto) {
                Storage::disk('public')->delete('santri/' . $santri->foto);
            }
            
            $image = $request->file('foto');
            $path = $image->hashName();
            $image->storeAs('santri', $path);
            
            $validated['foto'] = $path;
            
        } else {
            unset($validated['foto']);
        }
        
        $santri->update($validated);

        return redirect()->route('santri.index')->with('success', 'Data santri berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $santri = \App\Models\Santri::findOrFail($id);
        $santri->delete();

        return redirect()->route('santri.index')->with('success', 'Data santri berhasil dihapus!');
    }
}
