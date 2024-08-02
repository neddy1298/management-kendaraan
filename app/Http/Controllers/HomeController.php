<?php

namespace App\Http\Controllers;

use App\Models\Belanja;
use App\Models\Kendaraan;
use App\Models\Maintenance;
use App\Models\MasterAnggaran;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {

        $master_anggaran = MasterAnggaran::orderBy('created_at', 'desc')->get()->first();
        $kendaraans = Kendaraan::orderBy('created_at', 'desc')->get();
        $kendaraan = Kendaraan::get()->count();
        $belanja_bulanan = Belanja::whereMonth('tanggal_belanja', date('m'))->sum(
            'belanja_bahan_bakar_minyak',
            'belanja_pelumas_mesin',
            'belanja_suku_cadang',
        );
        $belanja_tahunan = Belanja::whereYear('tanggal_belanja', date('Y'))->sum(
            'belanja_bahan_bakar_minyak',
            'belanja_pelumas_mesin',
            'belanja_suku_cadang',
        );
        $maintenances = Kendaraan::select('maintenances.*', 'kendaraans.berlaku_sampai', 'unit_kerjas.nama_unit_kerja')
            ->join('maintenances', 'maintenances.kendaraan_id', '=', 'kendaraans.id')
            ->join('unit_kerjas', 'kendaraans.unit_kerja_id', '=', 'unit_kerjas.id')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($maintenance) {
                try {
                    $maintenance->berlaku_sampai = Carbon::createFromFormat('Y-m-d', $maintenance->berlaku_sampai)->format('Y-m-d');
                } catch (\Exception $e) {
                    $maintenance->berlaku_sampai = null;
                }
                return $maintenance;
            });

        $isExpire = $maintenances->filter(function ($maintenance) {
            return $maintenance->berlaku_sampai && Carbon::parse($maintenance->berlaku_sampai)->lt(Carbon::today());
        });

        $belanja_mingguans = Belanja::whereBetween('tanggal_belanja', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->with('maintenance.kendaraan')->orderBy('created_at', 'desc')->get();

        $belanjas = Belanja::whereBetween('tanggal_belanja', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->orderBy('created_at', 'desc')
            ->get();

        // dd($belanjas);
        return view('home', compact('kendaraan', 'belanjas', 'master_anggaran', 'isExpire', 'belanja_bulanan', 'belanja_tahunan', 'belanja_mingguans'));
    }
}
