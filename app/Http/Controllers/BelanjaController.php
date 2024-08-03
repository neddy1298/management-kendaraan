<?php

namespace App\Http\Controllers;

use App\Models\Belanja;
use App\Models\Kendaraan;
use App\Models\Maintenance;
use App\Models\SukuCadang;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BelanjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $dateRange = $request->input('date-range');

        $query = Belanja::with(['maintenance.kendaraan', 'maintenance.kendaraan.unitKerja']);

        if ($dateRange) {
            $dates = explode(' - ', $dateRange);
            $startDate = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->startOfDay();
            $endDate = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->endOfDay();

            $query->whereBetween('tanggal_belanja', [$startDate, $endDate]);
        }

        $belanjas = $query->orderBy('tanggal_belanja', 'desc')->get();

        $belanja_periode = $belanjas->sum('belanja_bahan_bakar_minyak')
            + $belanjas->sum('belanja_pelumas_mesin')
            + $belanjas->sum('belanja_suku_cadang');

        $belanja_tahun_ini = Belanja::whereYear('tanggal_belanja', Carbon::now()->year)
            ->selectRaw('SUM(belanja_bahan_bakar_minyak + belanja_pelumas_mesin + belanja_suku_cadang) as total')
            ->value('total');

        $isExpire = $belanjas->filter(function ($belanja) {
            return $belanja->maintenance->kendaraan->berlaku_sampai < Carbon::now();
        })->count();

        return view('belanja.index', compact('belanjas', 'isExpire', 'belanja_periode', 'belanja_tahun_ini', 'dateRange'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $maintenances = Maintenance::with('kendaraan')
            ->get()
            ->unique('kendaraan_id');
        return view('belanja.create', compact('maintenances'));
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
            'maintenance_id' => 'required|integer',
            'belanja_bahan_bakar_minyak' => 'nullable|integer',
            'belanja_pelumas_mesin' => 'nullable|integer',
            'tanggal_belanja' => 'required|date_format:d/m/Y',
            'keterangan' => 'required|string|max:255',
            'nama_suku_cadang' => 'nullable|array',
            'nama_suku_cadang.*' => 'nullable|string',
            'jumlah_suku_cadang' => 'nullable|array',
            'jumlah_suku_cadang.*' => 'nullable|integer|min:1',
            'harga_suku_cadang' => 'nullable|array',
            'harga_suku_cadang.*' => 'nullable|integer|min:0',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'date_format' => 'Format tanggal harus :format.',
        ]);

        $validatedData['tanggal_belanja'] = Carbon::createFromFormat('d/m/Y', $validatedData['tanggal_belanja'])->format('Y-m-d');

        DB::beginTransaction();

        try {
            $maintenance = $this->getOrCreateMaintenance($validatedData);
            $belanja = $this->createBelanja($validatedData, $maintenance);
            $this->createSukuCadangs($validatedData, $belanja);

            DB::commit();
            return redirect()->route('belanja.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('belanja.index')->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    private function getOrCreateMaintenance($data)
    {
        $maintenance = Maintenance::findOrFail($data['maintenance_id']);
        $belanjaMonth = Carbon::parse($data['tanggal_belanja'])->format('Y-m');

        $existingMaintenance = Maintenance::where('kendaraan_id', $maintenance->kendaraan_id)
            ->whereYear('tanggal_maintenance', Carbon::parse($data['tanggal_belanja'])->year)
            ->whereMonth('tanggal_maintenance', Carbon::parse($data['tanggal_belanja'])->month)
            ->first();

        if ($existingMaintenance) {
            $existingMaintenance->update([
                'tanggal_maintenance' => $data['tanggal_belanja'],
                'keterangan' => $existingMaintenance->keterangan . ' ' . $data['keterangan'],
            ]);
            return $existingMaintenance;
        }

        return Maintenance::create([
            'kendaraan_id' => $maintenance->kendaraan_id,
            'tanggal_maintenance' => $data['tanggal_belanja'],
            'keterangan' => $data['keterangan'],
        ]);
    }

    private function createBelanja($data, $maintenance)
    {
        return Belanja::create([
            'maintenance_id' => $maintenance->id,
            'belanja_bahan_bakar_minyak' => $data['belanja_bahan_bakar_minyak'] ?? 0,
            'belanja_pelumas_mesin' => $data['belanja_pelumas_mesin'] ?? 0,
            'tanggal_belanja' => $data['tanggal_belanja'],
            'keterangan' => $data['keterangan'],
        ]);
    }

    private function createSukuCadangs($data, $belanja)
    {
        if (!empty($data['nama_suku_cadang'])) {
            $sukuCadangs = [];
            foreach ($data['nama_suku_cadang'] as $key => $nama) {
                if (!empty($nama) && isset($data['jumlah_suku_cadang'][$key]) && isset($data['harga_suku_cadang'][$key])) {
                    $sukuCadangs[] = [
                        'belanja_id' => $belanja->id,
                        'nama_suku_cadang' => $nama,
                        'jumlah' => $data['jumlah_suku_cadang'][$key],
                        'harga_satuan' => $data['harga_suku_cadang'][$key],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
            if (!empty($sukuCadangs)) {
                SukuCadang::insert($sukuCadangs);
            }
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
        return view('belanja.show', compact('belanjas'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $belanja = Belanja::findOrFail($id);
        $belanja->delete();
        return redirect()->route('belanja.index')->with('success', 'Data berhasil dihapus.');
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View
     */

    public function printAll()
    {
        $datas = Belanja::with('maintenance.kendaraan')->get();
        return view('belanja.printAll', compact('datas'));
    }
}
