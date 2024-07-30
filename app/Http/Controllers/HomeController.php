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

        $master_anggaran = MasterAnggaran::all()->first();
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
        $maintenances = Kendaraan::select('tbl_maintenance.*', 'tbl_kendaraan.berlaku_sampai', 'tbl_unit_kerja.nama_unit_kerja')
            ->join('tbl_maintenance', 'tbl_maintenance.nomor_registrasi', '=', 'tbl_kendaraan.nomor_registrasi')
            ->join('tbl_unit_kerja', 'tbl_kendaraan.unit_kerja', '=', 'tbl_unit_kerja.id')
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

        $belanja_mingguans = Belanja::whereBetween('tanggal_belanja', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        
        $belanjas = Belanja::whereBetween('tanggal_belanja', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
        
        // dd($belanjas);
        return view('home', compact('kendaraan', 'belanjas', 'master_anggaran', 'expireDate', 'belanja_bulanan','belanja_tahunan', 'belanja_mingguans'));
    }
}
