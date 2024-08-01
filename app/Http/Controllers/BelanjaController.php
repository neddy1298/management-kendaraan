<?php

namespace App\Http\Controllers;

use App\Models\Belanja;
use App\Models\Kendaraan;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BelanjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $belanjas = Belanja::orderBy('created_at', 'desc')->get();
        return view('belanja.index', compact('belanjas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $kendaraans = Kendaraan::select('nomor_registrasi', 'merk_kendaraan', 'jenis_kendaraan')->get();
        return view('belanja.create', compact('kendaraans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nomor_registrasi' => 'required|string|max:255',
            'belanja_bahan_bakar_minyak' => 'required_without_all:belanja_pelumas_mesin,belanja_suku_cadang|nullable|integer',
            'belanja_pelumas_mesin' => 'required_without_all:belanja_bahan_bakar_minyak,belanja_suku_cadang|nullable|integer',
            'belanja_suku_cadang' => 'required_without_all:belanja_bahan_bakar_minyak,belanja_pelumas_mesin|nullable|integer',
            'tanggal_belanja' => 'required|string|date_format:d/m/Y',
            'keterangan' => 'required|string|max:255',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'required_without_all' => 'Minimal salah satu kolom :attribute harus diisi.',
            'date_format' => 'Format tanggal harus :format.',
        ]);

        // Convert date format from d/m/Y to Y-m-d for consistency
        $validatedData['tanggal_belanja'] = Carbon::createFromFormat('d/m/Y', $validatedData['tanggal_belanja'])->format('Y-m-d');

        try {
            $belanja = Belanja::create($validatedData);

            $maintenance = Maintenance::find($validatedData['nomor_registrasi']);
            if ($maintenance) {
                $maintenance->update([
                    'belanja_bahan_bakar_minyak' => $maintenance->belanja_bahan_bakar_minyak + ($validatedData['belanja_bahan_bakar_minyak'] ?? 0),
                    'belanja_pelumas_mesin' => $maintenance->belanja_pelumas_mesin + ($validatedData['belanja_pelumas_mesin'] ?? 0),
                    'belanja_suku_cadang' => $maintenance->belanja_suku_cadang + ($validatedData['belanja_suku_cadang'] ?? 0),
                    'keterangan' => $maintenance->keterangan . ' ' . $belanja->keterangan,
                ]);
            }

            return redirect()->route('belanja.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->route('belanja.index')->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Belanja  $belanja
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Belanja $belanja)
    {
        return view('belanja.show', compact('belanja'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $belanja = Belanja::find($id);

        if ($belanja) {
            try {
                $nomor_registrasi = $belanja->nomor_registrasi;
                $belanja->delete();

                $maintenance = Maintenance::where('nomor_registrasi', $nomor_registrasi)->first();
                if ($maintenance) {
                    $maintenance->update([
                        'belanja_bahan_bakar_minyak' => $maintenance->belanja_bahan_bakar_minyak - ($belanja->belanja_bahan_bakar_minyak ?? 0),
                        'belanja_pelumas_mesin' => $maintenance->belanja_pelumas_mesin - ($belanja->belanja_pelumas_mesin ?? 0),
                        'belanja_suku_cadang' => $maintenance->belanja_suku_cadang - ($belanja->belanja_suku_cadang ?? 0),
                        'keterangan' => preg_replace('/\b' . preg_quote($belanja->keterangan, '/') . '\b/', '', $maintenance->keterangan),
                    ]);
                }

                return redirect()->route('belanja.index')->with('success', 'Data berhasil dihapus.');
            } catch (\Exception $e) {
                return redirect()->route('belanja.index')->with('error', 'Terjadi kesalahan saat menghapus data.');
            }
        }

        return redirect()->route('belanja.index')->with('error', 'Data tidak ditemukan.');
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View
     */

    public function printAll()
    {
        $datas = Belanja::all();
        return view('belanja.printAll', compact('datas'));
    }
}
