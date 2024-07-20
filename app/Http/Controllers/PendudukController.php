<?php

namespace App\Http\Controllers;

use App\Models\KepalaKeluarga;
use App\Models\Penduduk;
use App\Models\PermohonanKtp;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function index()
    {
        $penduduks = Penduduk::all();
        return view('penduduk.index', compact('penduduks'));
    }

    public function create()
    {
        $kepala_keluargas = KepalaKeluarga::all();
        return view('penduduk.create', compact('kepala_keluargas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'nkk' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kelurahan_desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'agama' => 'required',
            'status' => 'required',
            'pekerjaan' => 'required',
            'kewarganegaraan' => 'required',
        ],[
            'required' => 'Kolom :attribute wajib diisi.',
        ]);


        $data = $request->all();
        $tanggal_lahir = Carbon::createFromFormat('d/m/Y', $request->input('tanggal_lahir'))->format('Y-m-d');
        $data['tanggal_lahir'] = $tanggal_lahir;
        
        Penduduk::create($data);

        return redirect()->route('penduduk.index')
            ->with('success', 'Data Penduduk berhasil ditambahkan');
    }

    public function printAll()
    {
        $datas = Penduduk::all();
        return view('penduduk.printAll', compact('datas'));
    }

    public function print(string $id)
    {
        $data = Penduduk::findOrFail($id);
        return view('penduduk.print', compact('data'));
    }

    public function edit($nik)
    {
        $kepala_keluargas = KepalaKeluarga::all();
        $penduduk = Penduduk::find($nik);
        return view('penduduk.edit', compact('penduduk', 'kepala_keluargas'));
    }

    public function update(Request $request, $nik)
    {
        $request->validate([
            'nkk' => 'required|numeric',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'kelurahan_desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'agama' => 'required',
            'status' => 'required',
            'pekerjaan' => 'required',
            'kewarganegaraan' => 'required',
        ],[
            'required' => 'Kolom :attribute wajib diisi.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
        ]);

        $data = $request->all();
        $tanggal_lahir = Carbon::createFromFormat('d/m/Y', $request->input('tanggal_lahir'))->format('Y-m-d');
        $data['tanggal_lahir'] = $tanggal_lahir;
        
        $penduduk = Penduduk::find($nik);
        $penduduk->update($data);

        return redirect()->route('penduduk.index')
            ->with('success', 'Data Penduduk berhasil diperbarui');
    }

    public function destroy($nik)
    {
        $permohonanKtps = PermohonanKtp::where('nik', $nik)->get();
        if ($permohonanKtps->isEmpty()) {
            Penduduk::destroy($nik);
            return redirect()->route('penduduk.index')
                ->with('success', 'Data Penduduk berhasil dihapus');
        } else {
            return redirect()->route('penduduk.index')
                ->with('error', 'Data Penduduk tidak dapat dihapus karena terkait dengan Permohonan KTP');
        }
    }
}
