<?php

namespace App\Http\Controllers;

use App\Models\Belanja;
use App\Models\GroupAnggaran;
use App\Models\Kendaraan;
use App\Models\StokSukuCadang;
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

        $query = Belanja::with('kendaraan');

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

        $belanja_bbm_periode = $belanjas->sum('belanja_bahan_bakar_minyak');
        $belanja_pelumas_periode = $belanjas->sum('belanja_pelumas_mesin');
        $belanja_suku_cadang_periode = $belanjas->sum('belanja_suku_cadang');

        $belanja_tahun_ini = Belanja::whereYear('tanggal_belanja', Carbon::now()->year)
            ->selectRaw('SUM(belanja_bahan_bakar_minyak + belanja_pelumas_mesin + belanja_suku_cadang) as total')
            ->value('total');

        $isExpire = Belanja::whereHas('kendaraan', function ($query) {
            $query->where('berlaku_sampai', '<', Carbon::now());
        })->count();

        return view('belanja.index', compact('belanjas', 'isExpire', 'belanja_periode', 'belanja_bbm_periode', 'belanja_pelumas_periode', 'belanja_suku_cadang_periode', 'dateRange'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $kendaraans = Kendaraan::all();
        $groupAnggarans = GroupAnggaran::all();
        $stokSukuCadangs = StokSukuCadang::all();
        return view('belanja.create', compact('kendaraans', 'groupAnggarans', 'stokSukuCadangs'));
    }

    public function getKendaraan($group_anggaran_id)
    {
        $kendaraans = Kendaraan::whereHas('groupAnggarans', function ($query) use ($group_anggaran_id) {
            $query->where('group_anggaran_id', $group_anggaran_id);
        })->get();
        return response()->json($kendaraans);
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
            'group_anggaran_id' => 'required|integer',
            'kendaraan_id' => 'required|integer',
            'belanja_bahan_bakar_minyak' => 'nullable|integer',
            'belanja_pelumas_mesin' => 'nullable|integer',
            'tanggal_belanja' => 'required|date_format:d/m/Y',
            'keterangan' => 'nullable|string',
            'nama_suku_cadang' => 'nullable|array',
            'jumlah_suku_cadang' => 'nullable|array',
            'harga_suku_cadang' => 'nullable|array',
            'nama_suku_cadang.*' => 'required_with:jumlah_suku_cadang.*,harga_suku_cadang.*|integer',
            'jumlah_suku_cadang.*' => 'required_with:nama_suku_cadang.*,harga_suku_cadang.*|integer|min:1',
            'harga_suku_cadang.*' => 'required_with:nama_suku_cadang.*,jumlah_suku_cadang.*|integer|min:0',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'date_format' => 'Format tanggal harus :format.',
        ]);

        $validatedData['tanggal_belanja'] = Carbon::createFromFormat('d/m/Y', $validatedData['tanggal_belanja'])->format('Y-m-d');

        DB::beginTransaction();
        try {
            $belanja = $this->createBelanja($validatedData);
            $this->createSukuCadangs($validatedData, $belanja);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        return redirect()->route('belanja.index')->with('success', 'Data berhasil disimpan.');
    }

    private function createBelanja($data)
    {
        return Belanja::create([
            'group_anggaran_id' => $data['group_anggaran_id'],
            'kendaraan_id' => $data['kendaraan_id'],
            'belanja_bahan_bakar_minyak' => $data['belanja_bahan_bakar_minyak'] ?? 0,
            'belanja_pelumas_mesin' => $data['belanja_pelumas_mesin'] ?? 0,
            'tanggal_belanja' => $data['tanggal_belanja'],
            'keterangan' => $data['keterangan'],
        ]);
    }

    private function createSukuCadangs($data, $belanja)
    {
        if (!empty($data['nama_suku_cadang'])) {
            foreach ($data['nama_suku_cadang'] as $key => $sukuCadangId) {
                if (!empty($sukuCadangId) && isset($data['jumlah_suku_cadang'][$key]) && isset($data['harga_suku_cadang'][$key])) {
                    $stokSukuCadang = StokSukuCadang::findOrFail($sukuCadangId);
                    $jumlah = $data['jumlah_suku_cadang'][$key];
                    $harga = $data['harga_suku_cadang'][$key];

                    if ($jumlah > $stokSukuCadang->stok) {
                        throw new \Exception('Jumlah suku cadang melebihi stok yang tersedia.');
                    }

                    $sukuCadang = new SukuCadang([
                        'belanja_id' => $belanja->id,
                        'stok_suku_cadang_id' => $stokSukuCadang->id,
                        'jumlah' => $jumlah,
                        'harga_satuan' => $harga,
                    ]);
                    $sukuCadang->save();

                    // Update total belanja_suku_cadang di model Belanja
                    $belanja->belanja_suku_cadang += $sukuCadang->jumlah * $sukuCadang->harga_satuan;

                    // Reduce stock
                    $stokSukuCadang->stok -= $jumlah;
                    $stokSukuCadang->save();
                }
            }
            // Simpan perubahan pada model Belanja
            $belanja->save();
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
        return to_route('belanja.index')->with('success', 'Data berhasil dihapus.');
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View
     */

    public function printAll()
    {
        $datas = Belanja::with('kendaraan')->get();
        return view('belanja.printAll', compact('datas'));
    }
}
