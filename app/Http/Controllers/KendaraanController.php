<?php

namespace App\Http\Controllers;

use App\Models\GroupAnggaran;
use App\Models\Kendaraan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $kendaraans = Kendaraan::with('belanjas')->orderBy('created_at', 'desc')->get();

        $isExpire = $kendaraans->filter(function ($kendaraan) {
            return $kendaraan->berlaku_sampai->isPast();
        })->count();

        return view('kendaraan.index', compact('kendaraans', 'isExpire'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $groupAnggarans = GroupAnggaran::orderBy('created_at', 'desc')->get();
        return view('kendaraan.create', compact('groupAnggarans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateKendaraan($request);

        $validatedData['berlaku_sampai'] = Carbon::createFromFormat('d/m/Y', $validatedData['berlaku_sampai'])->format('Y-m-d');

        $kendaraan = Kendaraan::create($validatedData);

        // Attach group anggaran to kendaraan
        $kendaraan->groupAnggarans()->attach($request->groupAnggaran_id);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $kendaraan = Kendaraan::with('belanjas')->findOrFail($id);
        $groupAnggarans = GroupAnggaran::orderBy('created_at', 'desc')->get();
        $selectedGroupAnggarans = $kendaraan->groupAnggarans->pluck('id')->toArray();
        return view('kendaraan.edit', compact('kendaraan', 'groupAnggarans', 'selectedGroupAnggarans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateKendaraan($request, $id);

        $validatedData['berlaku_sampai'] = Carbon::createFromFormat('d/m/Y', $validatedData['berlaku_sampai'])->format('Y-m-d');

        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update($validatedData);
        $kendaraan->groupAnggarans()->sync($request->groupAnggaran_id);

        return to_route('kendaraan.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        if ($kendaraan) {
            $kendaraan->delete();
            return to_route('kendaraan.index')->with('success', 'Data berhasil dihapus.');
        } else {
            return to_route('kendaraan.index')->with('error', 'Data tidak ditemukan.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function printAll()
    {
        $kendaraans = Kendaraan::orderBy('roda_kendaraan', 'asc')->get();
        return view('kendaraan.printAll', compact('kendaraans'));
    }

    /**
     * Validate kendaraan data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateKendaraan(Request $request, $id = null)
    {
        $uniqueRule = 'unique:kendaraans,nomor_registrasi';
        if ($id) {
            $uniqueRule .= ',' . $id;
        }

        return $request->validate([
            'nomor_registrasi' => ['required', 'string', 'max:255', $uniqueRule],
            'merk_kendaraan' => 'required|string|max:255',
            'jenis_kendaraan' => 'required|string|max:255',
            'cc_kendaraan' => 'required|integer',
            'bbm_kendaraan' => 'required|string|max:255',
            'roda_kendaraan' => 'required|integer',
            'berlaku_sampai' => 'required|date_format:d/m/Y',
            'groupAnggaran_id' => 'required|array',
            'groupAnggaran_id.*' => 'exists:group_anggarans,id',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'date_format' => 'Kolom :attribute tidak sesuai format d/m/Y.',
            'unique' => 'Nomor registrasi sudah digunakan.',
        ]);
    }
}
