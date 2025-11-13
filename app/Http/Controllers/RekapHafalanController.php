<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\WaliSantri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekapHafalanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        if (Auth::user()->role === 'santri') {
            $santri = Auth::user()->santri;

            if ($santri) {
                $data = collect([$santri]); // bungkus dalam koleksi agar tetap bisa di-loop di view
            } else {
                $data = collect([]); // kosong kalau belum punya data santri
            }
        } else if (Auth::user()->role === 'walisantri') {
            $walisantri = WaliSantri::with('santri')->where('user_id', Auth::id())->first();
            $santri = $walisantri->santri;

            if ($santri) {
                $data = collect([$santri]); // bungkus dalam koleksi agar tetap bisa di-loop di view
            } else {
                $data = collect([]); // kosong kalau belum punya data santri
            }
        } else {
            $data = Santri::all();
        }

        return view('pages.rekap-hafalan.index', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
