<?php

namespace App\Http\Controllers;

use App\Models\KepalaKeluarga;
use App\Models\Penduduk;
use App\Models\PermohonanKtp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PermohonanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permohonans = PermohonanKtp::join('tbl_penduduk', 'tbl_penduduk.nik', '=', 'tbl_permohonan_ktp.nik')
            ->join('tbl_kepala_keluarga', 'tbl_kepala_keluarga.nkk', '=', 'tbl_penduduk.nkk')
            ->get();
        return view('permohonan.index', compact('permohonans'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kepalaKeluargas = KepalaKeluarga::all();
        $penduduks = Penduduk::all();
        return view('permohonan.create', compact('kepalaKeluargas', 'penduduks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {          
        $request->validate([
            'nik' => 'required',
            'nkk' => 'required',
            'jenis_permohonan' => 'required',
            'keterangan' => 'required',
        ],[
            'required' => 'Kolom :attribute wajib diisi.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
        ]);

        $data = $request->all();

        // Ubah format tanggal lahir
        $tanggal_lahir = Carbon::createFromFormat('d/m/Y', $request->input('tanggal_lahir'))->format('Y-m-d');
        $data['tanggal_lahir'] = $tanggal_lahir;

        $permohonanKtp = PermohonanKtp::create($data);

        if ($permohonanKtp->wasRecentlyCreated) {
            return redirect()->route('permohonan.index')->with('success', 'Permohonan KTP berhasil disimpan.');
        } else {
            return redirect()->route('permohonan.index')->with('error', 'Terjadi kesalahan saat menyimpan permohonan KTP.');
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function printAll()
    {
        $datas = PermohonanKtp::join('tbl_penduduk', 'tbl_penduduk.nik', '=', 'tbl_permohonan_ktp.nik')
            ->join('tbl_kepala_keluarga', 'tbl_kepala_keluarga.nkk', '=', 'tbl_penduduk.nkk')
            ->get();
        return view('permohonan.printAll', compact('datas'));
    }

    public function print(string $id)
    {        
        $data = PermohonanKtp::join('tbl_penduduk', 'tbl_penduduk.nik', '=', 'tbl_permohonan_ktp.nik')
            ->join('tbl_kepala_keluarga', 'tbl_kepala_keluarga.nkk', '=', 'tbl_penduduk.nkk')
            ->where('tbl_permohonan_ktp.id', $id)
            ->first();
        return view('permohonan.print', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        // $permohonan = PermohonanKtp::findOrFail($id);
        $permohonan = PermohonanKtp::join('tbl_penduduk', 'tbl_penduduk.nik', '=', 'tbl_permohonan_ktp.nik')
            ->join('tbl_kepala_keluarga', 'tbl_kepala_keluarga.nkk', '=', 'tbl_penduduk.nkk')
            ->where('tbl_permohonan_ktp.id', $id)
            ->first();
        // dump($permohonan);
        return view('permohonan.edit', compact('permohonan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $permohonan = PermohonanKtp::findOrFail($id);

        $request->validate([
            'nik' => 'required|unique:tbl_permohonan_ktp,nik',
            'jenis_permohonan' => 'required',
            'keterangan' => 'required',
        ],[
            'nik.unique' => 'NIK sudah terdaftar.',
            'required' => 'Kolom :attribute wajib diisi.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
        ]);

        $data = $request->all();

        // Ubah format tanggal lahir
        $tanggal_lahir = Carbon::createFromFormat('d/m/Y', $request->input('tanggal_lahir'))->format('Y-m-d');
        $data['tanggal_lahir'] = $tanggal_lahir;

        $permohonan->update($data);

        return redirect()->route('permohonan.index')->with('success', 'Permohonan KTP berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permohonan = PermohonanKtp::findOrFail($id);
        $permohonan->delete();

        return redirect()->route('permohonan.index')->with('success', 'Permohonan KTP berhasil dihapus.');
    }
}
