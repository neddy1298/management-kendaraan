<?php

namespace App\Http\Controllers;

use App\Models\Belanja;
use App\Models\Maintenance;
use Carbon\Carbon;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $maintenances = Maintenance::with('kendaraan', 'belanja')
            ->orderBy('maintenances.updated_at', 'desc')
            ->get();


        // dd($maintenances[0]->belanja);

        $bulan_ini = Carbon::now()->format('m');
        $tahun_ini = Carbon::now()->format('Y');

        $belanja_bulan_ini = 0;
        $belanja_tahun_ini = 0;
        $isExpire = 0;

        foreach ($maintenances as $maintenance) {
            $belanja_bulan_ini += $maintenance->belanja()
            ->whereMonth('tanggal_belanja', $bulan_ini)
            ->sum('belanja_bahan_bakar_minyak') +
            $maintenance->belanja()
            ->whereMonth('tanggal_belanja', $bulan_ini)
            ->sum('belanja_pelumas_mesin') +
            $maintenance->belanja()
            ->whereMonth('tanggal_belanja', $bulan_ini)
            ->sum('belanja_suku_cadang');

            $belanja_tahun_ini += $maintenance->belanja()
            ->whereYear('tanggal_belanja', $tahun_ini)
            ->sum('belanja_bahan_bakar_minyak') +
            $maintenance->belanja()
            ->whereYear('tanggal_belanja', $tahun_ini)
            ->sum('belanja_pelumas_mesin') +
            $maintenance->belanja()
            ->whereYear('tanggal_belanja', $tahun_ini)
            ->sum('belanja_suku_cadang');

            $isExpire += $maintenance->kendaraan()
            ->where('berlaku_sampai', '<',Carbon::now())
            ->count();
        }

        return view('maintenance.index', compact('maintenances', 'isExpire', 'belanja_bulan_ini', 'belanja_tahun_ini'));
    }

    /**
     * Get belanja details for a specific maintenance_id.
     *
     * @param  string  $maintenance_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBelanjaDetails($maintenance_id)
    {
        $belanjas = Belanja::where('maintenance_id', $maintenance_id)->get();

        // dd($maintenance_id);
        return response()->json($belanjas);
    }
}
