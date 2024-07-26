<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Maintenance;
use App\Models\MtGroup;
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
        $kendaraans = Kendaraan::all()->map(function ($kendaraan) {
            $kendaraan->berlaku_sampai = Carbon::createFromFormat('d/m/Y', $kendaraan->berlaku_sampai)->format('Y/m/d');
            return $kendaraan;
        });
        return view('kendaraan.index', compact('kendaraans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $mt_groups = MtGroup::all();
        return view('kendaraan.create', compact('mt_groups'));
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
            'nomor_registrasi' => 'required|string|max:255|unique:tbl_kendaraan',
            'merk_kendaraan' => 'required|string|max:255',
            'jenis_kendaraan' => 'required|string|max:255',
            'cc_kendaraan' => 'required|integer',
            'bbm_kendaraan' => 'required|string|max:255',
            'roda_kendaraan' => 'required|integer',
            'berlaku_sampai' => 'required|date_format:d/m/Y',
            'mt_group' => 'required|integer',
        ],[
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'date_format' => 'Kolom :attribute tidak sesuai format d/m/Y.',
            'unique' => 'Nomor registrasi sudah digunakan.',
        ]);

        $validatedData['berlaku_sampai'] = Carbon::createFromFormat('d/m/Y', $validatedData['berlaku_sampai'])->format('d/m/Y');
        $kendaraan = Kendaraan::create($validatedData);

        $maintenanceData = [
            'nomor_registrasi' => $request->nomor_registrasi,
            'mt_group' => $request->mt_group,
        ];
        Maintenance::create($maintenanceData);

        if ($kendaraan->wasRecentlyCreated) {
            return redirect()->route('kendaraan.index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->route('kendaraan.index')->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function printAll()
    {
        return view('kendaraan.printAll');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $kendaraan = Kendaraan::find($id);
        $maintenance = Maintenance::where('nomor_registrasi', $kendaraan->nomor_registrasi)
            ->join('tbl_mt_group', 'tbl_maintenance.mt_group', '=', 'tbl_mt_group.id')
            ->select('tbl_maintenance.nomor_registrasi', 'tbl_mt_group.id', 'tbl_mt_group.nama_group')
            ->first();
    
        $mt_groups = MtGroup::all();
    
        return view('kendaraan.edit', compact('kendaraan', 'mt_groups', 'maintenance'));
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
        $validatedData = $request->validate([
            'nomor_registrasi' => 'required|string|max:255',
            'merk_kendaraan' => 'required|string|max:255',
            'jenis_kendaraan' => 'required|string|max:255',
            'cc_kendaraan' => 'required|integer',
            'bbm_kendaraan' => 'required|string|max:255',
            'roda_kendaraan' => 'required|integer',
            'berlaku_sampai' => 'required|date_format:d/m/Y',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'date_format' => 'Kolom :attribute tidak sesuai format d/m/Y.',
        ]);

        $validatedData['berlaku_sampai'] = Carbon::createFromFormat('d/m/Y', $validatedData['berlaku_sampai'])->format('d/m/Y');
        
        $kendaraan = Kendaraan::find($id);
        $kendaraan->update($validatedData);

        return redirect()->route('kendaraan.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $kendaraan = Kendaraan::find($id);

        if ($kendaraan) {
            $kendaraan->delete();
            return redirect()->route('kendaraan.index')->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->route('kendaraan.index')->with('error', 'Data tidak ditemukan.');
        }
    }
}
