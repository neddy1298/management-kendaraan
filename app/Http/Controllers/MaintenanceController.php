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
        $maintenances = Maintenance::all();
        $belanjas = Belanja::all();

        $maintenances = Maintenance::join('kendaraans', 'maintenances.kendaraan_id', '=', 'kendaraans.id')
            ->join('unit_kerjas', 'kendaraans.unit_kerja_id', '=', 'unit_kerjas.id')
            ->select('maintenances.*', 'kendaraans.berlaku_sampai', 'kendaraans.nomor_registrasi', 'unit_kerjas.nama_unit_kerja')
            ->get()
            ->map(function ($maintenance) {
                try {
                    $maintenance->berlaku_sampai = Carbon::createFromFormat('d/m/Y', $maintenance->berlaku_sampai)->format('Y-m-d');
                } catch (\Exception $e) {
                    $maintenance->berlaku_sampai = null;
                }
                return $maintenance;
            });

        $expireDate = $maintenances->filter(function ($maintenance) {
            return $maintenance->berlaku_sampai && Carbon::parse($maintenance->berlaku_sampai)->lt(Carbon::today());
        });

        $bulan_ini = Carbon::now()->format('m');
        $tahun_ini = Carbon::now()->format('Y');

        $filteredBulanIni = $belanjas->filter(function ($belanja) use ($bulan_ini) {
            return Carbon::parse($belanja->tanggal_belanja)->format('m') == $bulan_ini;
        });

        $filteredTahunIni = $belanjas->filter(function ($belanja) use ($tahun_ini) {
            return Carbon::parse($belanja->tanggal_belanja)->format('Y') == $tahun_ini;
        });

        $belanja_bulan_ini = $filteredBulanIni->sum('belanja_bahan_bakar_minyak') +
            $filteredBulanIni->sum('belanja_pelumas_mesin') +
            $filteredBulanIni->sum('belanja_suku_cadang');

        $belanja_tahun_ini = $filteredTahunIni->sum('belanja_bahan_bakar_minyak') +
            $filteredTahunIni->sum('belanja_pelumas_mesin') +
            $filteredTahunIni->sum('belanja_suku_cadang');

        return view('maintenance.index', compact('maintenances', 'expireDate', 'belanja_bulan_ini', 'belanja_tahun_ini'));
    }

    /**
     * Get belanja details for a specific nomor_registrasi.
     *
     * @param  string  $nomor_registrasi
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBelanjaDetails($nomor_registrasi)
    {
        $belanjas = Belanja::where('nomor_registrasi', $nomor_registrasi)->get()->map(function ($belanja) {
            if (!is_null($belanja->tanggal_belanja)) {
                $belanja->tanggal_belanja = Carbon::parse($belanja->tanggal_belanja)->format('d/m/Y');
            }
            return $belanja;
        });

        return response()->json($belanjas);
    }
}
