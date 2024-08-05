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
        $unitKerjas = UnitKerja::withCount('kendaraans')->with('groupAnggarans')->get();

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
            'nama_unit_kerja' => 'required|string|max:255|unique:unit_kerjas',
            'group_anggaran_id' => 'required|array',
            'group_anggaran_id.*' => 'exists:group_anggarans,id',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'unique' => 'Nama Unit Kerja sudah digunakan.',
            'exists' => 'Group Anggaran yang dipilih tidak valid.',
        ]);

        $unitKerja = UnitKerja::create([
            'nama_unit_kerja' => $validatedData['nama_unit_kerja'],
        ]);

        $unitKerja->groupAnggarans()->attach($validatedData['group_anggaran_id']);

        if ($unitKerja->wasRecentlyCreated) {
            return to_route('unitKerja.index')->with('success', 'Data berhasil disimpan.');
        } else {
            return to_route('unitKerja.index')->with('error', 'Terjadi kesalahan saat menyimpan data.');
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

        return to_route('unitKerja.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $unitkerja = unitKerja::findOrFail($id);

        if ($unitkerja) {
            $unitkerja->delete();
            return to_route('unitKerja.index')->with('success', 'Data berhasil dihapus.');
        } else {
            return to_route('unitKerja.index')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function getUnitKerjaDetails($id)
    {
        $unitKerjas = UnitKerja::with('kendaraans')->findOrFail($id);
        return response()->json($unitKerjas);
    }
}
