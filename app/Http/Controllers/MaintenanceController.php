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
        $maintenances = Maintenance::with(['mtGroup', 'kendaraan'])
            ->select('tbl_maintenance.*', 'tbl_kendaraan.berlaku_sampai', 'tbl_mt_group.nama_group')
            ->join('tbl_mt_group', 'tbl_maintenance.mt_group', '=', 'tbl_mt_group.id')
            ->join('tbl_kendaraan', 'tbl_maintenance.nomor_registrasi', '=', 'tbl_kendaraan.nomor_registrasi')
            ->get()
            ->map(function ($maintenance) {
                $maintenance->berlaku_sampai = Carbon::createFromFormat('d/m/Y', $maintenance->berlaku_sampai)->format('Y-m-d');
                return $maintenance;
            });

        $expireDate = $maintenances->filter(function ($maintenance) {
            return Carbon::parse($maintenance->berlaku_sampai)->lt(Carbon::today());
        });

        return view('maintenance.index', compact('maintenances', 'expireDate'));
    }

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
