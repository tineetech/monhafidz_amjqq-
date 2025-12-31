<?php

namespace App\Http\Controllers;

use App\Models\JadwalHafalan;
use App\Models\Ustadzah;
use Illuminate\Http\Request;

class JadwalHafalanController extends Controller
{
    /**
     * Tampilkan daftar jadwal hafalan.
     */
    public function index()
    {
        $ziyadah = JadwalHafalan::where('jenis_hafalan', 'ziyadah')->get();
        $murajaah = JadwalHafalan::where('jenis_hafalan', 'murajaah')->get();

        return view('pages.jadwal-hafalan.index', compact('ziyadah', 'murajaah'));
    }

    public function show() {

    }
    /**
     * Tampilkan form edit jadwal hafalan.
     */
    public function editAddon()
    {
        $type = request()->query('type');
        
        $pembimbing_putra = Ustadzah::where('jenis_kelamin', 'Laki-laki')->get();
        $pembimbing_putri = Ustadzah::where('jenis_kelamin', 'Perempuan')->get();

        return view('pages.jadwal-hafalan.edit', compact('type', 'pembimbing_putra', 'pembimbing_putri'));
    }

    /**
     * Update data jadwal hafalan.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'jenis_hafalan' => 'required|in:ziyadah,murajaah',
            'hari' => 'required|string|max:50',
            'jam_mulai' => 'required|date_format:H:i',
            'pembimbing_putra_id' => 'nullable|exists:ustadzah,id',
            'pembimbing_putri_id' => 'nullable|exists:ustadzah,id',
        ]);
        
        if (!$validated) {
            return redirect()->back()
                             ->withErrors('Terjadi kesalahan saat memperbarui jadwal hafalan.')
                             ->withInput();
        }

        $jadwal = JadwalHafalan::where('jenis_hafalan', $request->jenis_hafalan)->where('hari', $request->hari)->firstOrFail();
        $jadwal->update($request->all());


        return redirect()->route('jadwal-hafalan.index')
                         ->with('success', 'Jadwal hafalan berhasil diperbarui.');
    }

    
    public function destroy($id)
    {
        $jadwal = JadwalHafalan::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal-hafalan.index')->with('success', 'Data jadwal hafalan berhasil dihapus!');
    }
}
