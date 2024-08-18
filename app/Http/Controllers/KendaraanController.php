<?php

namespace App\Http\Controllers;

use App\Models\GroupAnggaran;
use App\Models\Kendaraan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    
    public function index()
    {
        // $kendaraans = Kendaraan::with('belanjas')->orderBy('cc_kendaraan', 'desc')->get();
        $kendaraans = Kendaraan::with('belanjas')->orderByRaw('CAST(roda_kendaraan AS UNSIGNED)')->orderBy('cc_kendaraan', 'asc')->orderBy('anggaran_pertahun_kendaraan', 'asc')
            ->get();

        $isExpire = $kendaraans->filter(function ($kendaraan) {
            return $kendaraan->berlaku_sampai->isPast();
        })->count();

        return view('kendaraan.index', compact('kendaraans', 'isExpire'));
    }
    
    public function create()
    {
        $groupAnggarans = GroupAnggaran::orderBy('created_at', 'desc')->get();
        return view('kendaraan.create', compact('groupAnggarans'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $this->validateKendaraan($request);

        $validatedData['berlaku_sampai'] = $this->formatDate($validatedData['berlaku_sampai']);

        $kendaraan = Kendaraan::create($validatedData);

        $kendaraan->groupAnggarans()->attach($request->groupAnggaran_id);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan');
    }
    
    public function edit($id)
    {
        $kendaraan = Kendaraan::with('belanjas')->findOrFail($id);
        $groupAnggarans = GroupAnggaran::orderBy('created_at', 'desc')->get();
        $selectedGroupAnggarans = $kendaraan->groupAnggarans->pluck('id')->toArray();
        return view('kendaraan.edit', compact('kendaraan', 'groupAnggarans', 'selectedGroupAnggarans'));
    }
    
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateKendaraan($request, $id);

        $validatedData['berlaku_sampai'] = $this->formatDate($validatedData['berlaku_sampai']);

        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update($validatedData);
        $kendaraan->groupAnggarans()->sync($request->groupAnggaran_id);

        return to_route('kendaraan.index')->with('success', 'Data berhasil diperbarui.');
    }
    
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
    
    public function printAll()
    {
        $kendaraans = Kendaraan::orderBy('roda_kendaraan', 'asc')->get();
        return view('kendaraan.printAll', compact('kendaraans'));
    }
    
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
            'cc_kendaraan' => 'required|string',
            'bbm_kendaraan' => 'required|string|max:255',
            'roda_kendaraan' => 'required|integer',
            'berlaku_sampai' => 'required|date_format:d/m/Y',
            'anggaran_pertahun_kendaraan' => 'nullable|integer',
            'groupAnggaran_id' => 'required|array',
            'groupAnggaran_id.*' => 'exists:group_anggarans,id',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'date_format' => 'Kolom :attribute tidak sesuai format d/m/Y.',
            'unique' => 'Nomor registrasi sudah digunakan.',
        ]);
    }
    
    protected function formatDate($date)
    {
        return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
    }
}
