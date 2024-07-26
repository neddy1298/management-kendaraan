<?php

namespace App\Http\Controllers;

use App\Models\Belanja;
use App\Models\Maintenance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenances = Maintenance::join('tbl_mt_group', 'tbl_maintenance.mt_group', '=', 'tbl_mt_group.id')
            ->join('tbl_kendaraan', 'tbl_maintenance.nomor_registrasi', '=', 'tbl_kendaraan.nomor_registrasi')
            ->select('tbl_maintenance.*', 'tbl_kendaraan.berlaku_sampai', 'tbl_mt_group.nama_group')
            ->get();
        $maintenances = $maintenances->map(function ($maintenance) {
            $maintenance->berlaku_sampai = $maintenance->berlaku_sampai = Carbon::createFromFormat('d/m/Y', $maintenance->berlaku_sampai)->format('Y/m/d');
            return $maintenance;
        });
        return view('maintenance.index', compact('maintenances'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        return view('maintenance.show', [
            'maintenance' => $maintenance,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $maintenance = Maintenance::find($id);
        return view('maintenance.edit', compact('maintenance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $Maintenance = Maintenance::find($id);
        $Maintenance->update($request->all());

        return redirect()->route('maintenance.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function getBelanjaDetails($nomor_registrasi)
    {
        $belanjas = Belanja::where('nomor_registrasi', $nomor_registrasi)->get();
        return response()->json($belanjas);
    }
}
