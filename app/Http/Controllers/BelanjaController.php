<?php

namespace App\Http\Controllers;

use App\Models\Belanja;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class BelanjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('belanja.index', [
            'belanjas' => Belanja::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('belanja.create',[
            'kendaraans' => Kendaraan::select('nomor_registrasi', 'merk_kendaraan', 'jenis_kendaraan')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nomor_registrasi' => 'required|string|max:255',
            'belanja_bahan_bakar_minyak' => 'required_without_all:belanja_pelumas_mesin,belanja_suku_cadang|nullable|integer|max:255',
            'belanja_pelumas_mesin' => 'required_without_all:belanja_bahan_bakar_minyak,belanja_suku_cadang|nullable|integer|max:255',
            'belanja_suku_cadang' => 'required_without_all:belanja_bahan_bakar_minyak,belanja_pelumas_mesin|nullable|integer|max:255',
            'tanggal_belanja' => 'required|date_format:d/m/Y',
            'keterangan' => 'required|string|max:255',
        ],[
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'required_without_all' => 'Minimal salah satu kolom :attribute harus diisi.',
        ]);
        
        $validatedData['tanggal_belanja'] = \DateTime::createFromFormat('d/m/Y', $validatedData['tanggal_belanja'])->format('d-m-Y');
        $belanja = Belanja::create($validatedData);
        
        if ($belanja->wasRecentlyCreated) {
            return redirect()->route('belanja.index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->route('belanja.index')->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Belanja $belanja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Belanja $belanja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, belanja $belanja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Belanja $belanja)
    {
        //
    }
}
