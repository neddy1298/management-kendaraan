<?php

namespace App\Http\Controllers;

use App\Models\GroupAnggaran;
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
        $unitKerjas = UnitKerja::withCount('kendaraans')->with('groupAnggaran')->get();

        // dd($unitKerjas);
        return view('unitKerja.index', compact('unitKerjas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groupAnggarans = GroupAnggaran::orderBy('created_at', 'desc')->get();
        return view('unitKerja.create', compact('groupAnggarans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_unit_kerja' => 'required|string|max:255',
            'group_anggaran_id' => 'required|integer',
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
        $unitKerja = UnitKerja::findOrFail($id)->with('groupAnggaran')->first();
        $groupAnggarans = GroupAnggaran::orderBy('created_at', 'desc')->get();
        return view('unitKerja.edit', compact('unitKerja', 'groupAnggarans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_unit_kerja' => 'required|string|max:255',

        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
        ]);


        $unitKerjas = UnitKerja::findOrFail($id);
        $unitKerjas->update($validatedData);

        return redirect()->route('unitKerja.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $unitkerja = unitKerja::findOrFail($id);

        if ($unitkerja) {
            $unitkerja->delete();
            return redirect()->route('unitKerja.index')->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->route('unitKerja.index')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function getUnitKerjaDetails($id)
    {
        $unitKerjas = Maintenance::findOrFail($id);
        return response()->json($unitKerjas);
    }
}
