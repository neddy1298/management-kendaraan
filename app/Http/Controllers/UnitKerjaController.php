<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\UnitKerja;
use Illuminate\Http\Request;

class UnitKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unitKerjas = UnitKerja::withCount('maintenances')->get();

        return view('unitKerja.index', compact('unitKerjas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unitKerjas = UnitKerja::all();
        return view('unitKerja.create', compact('unitKerjas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_unit_kerja' => 'required|string|max:255|unique:tbl_unit_kerja',
            'budget_bahan_bakar_minyak' => 'required|integer',
            'budget_pelumas_mesin' => 'required|integer',
            'budget_suku_cadang' => 'required|integer',

        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
        ]);

        $unitKerjas = UnitKerja::create($validatedData);


        if ($unitKerjas->wasRecentlyCreated) {
            return redirect()->route('unitKerja.index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->route('unitKerja.index')->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UnitKerja $unitKerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) 
    {
        $unitKerja = unitKerja::find($id);

        return view('unitKerja.edit', compact('unitKerja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_unit_kerja' => 'required|string|max:255',
            'budget_bahan_bakar_minyak' => 'required|integer',
            'budget_pelumas_mesin' => 'required|integer',
            'budget_suku_cadang' => 'required|integer',

        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
        ]);


        $unitKerjas = UnitKerja::find($id);
        $unitKerjas->update($validatedData);

        return redirect()->route('unitKerja.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UnitKerja $unitKerja)
    {
        //
    }

    public function getUnitKerjaDetails($id)
    {
        $unitKerjas = Maintenance::where('unit_kerja', $id)->get();
        return response()->json($unitKerjas);
    }
}
