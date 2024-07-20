<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesaController extends Controller
{
    public function index()
    {
        $desa = Desa::where('user_id', Auth::id())->first();
        return view('desa.index', compact('desa'));
    }

    public function update(Request $request, $kode_desa)
    {
        $request->validate([
            'nama_desa' => 'required',
            'kode_kecamatan' => 'required',
            'nama_kecamatan' => 'required',
            'kode_kabupaten' => 'required',
            'nama_kabupaten' => 'required',
            'kode_provinsi' => 'required',
            'nama_provinsi' => 'required',
            'alamat_kantor' => 'required',
            'telepon' => 'required',
            'email' => 'required|email',
            'kode_pos' => 'required',
            'nama_kepala_desa' => 'required',
            'nip_kepala_desa' => 'required|numeric',
            'nama_sekretaris_desa' => 'required',
            'nip_sekretaris_desa' => 'required|numeric',
            'nama_bendahara_desa' => 'required',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
        ]);

        $desa = Desa::find($kode_desa);
        $desa->update($request->all());

        return redirect()->route('desa.index')
            ->with('success', 'Data Desa berhasil diupdate');
    }
}
