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
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $selectedMonth = $request->input('month', 'all');

        $query = Maintenance::with(['kendaraan', 'kendaraan.unitKerja', 'belanja']);

        $belanja_tahun_ini = 0;
        
        foreach ($query->get() as $maintenance) {
            $belanja_tahun_ini += $maintenance->belanja()
            ->whereYear('tanggal_belanja', Carbon::now()->year)
            ->sum('belanja_bahan_bakar_minyak')
            + $maintenance->belanja()
            ->whereYear('tanggal_belanja', Carbon::now()->year)
            ->sum('belanja_pelumas_mesin')
            + $maintenance->belanja()
            ->whereYear('tanggal_belanja', Carbon::now()->year)
            ->sum('belanja_suku_cadang');
        }
        if ($selectedMonth !== 'all') {
            $query->whereYear('tanggal_maintenance', substr($selectedMonth, 0, 4))
                ->whereMonth('tanggal_maintenance', substr($selectedMonth, 5, 2));
        }

        $maintenances = $query->orderBy('tanggal_maintenance', 'desc')->get();

        $belanja_bulan_ini = 0;
        $isExpire = 0;

        foreach ($maintenances as $maintenance) {
            $belanja_bulan_ini += $maintenance->belanja->sum('belanja_bahan_bakar_minyak')
                + $maintenance->belanja->sum('belanja_pelumas_mesin')
                + $maintenance->belanja->sum('belanja_suku_cadang');

            $isExpire += $maintenance->kendaraan->berlaku_sampai < Carbon::now() ? 1 : 0;
        }

        $months = $this->getAvailableMonths();

        return view('maintenance.index', compact('maintenances', 'isExpire', 'belanja_bulan_ini', 'belanja_tahun_ini', 'months', 'selectedMonth'));
    }

    private function getAvailableMonths()
    {
        $months = Maintenance::select('tanggal_maintenance')
            ->distinct()
            ->orderBy('tanggal_maintenance', 'desc')
            ->get()
            ->map(function ($item) {
                return Carbon::parse($item->tanggal_maintenance)->format('Y-m');
            })
            ->unique();

        return $months;
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
