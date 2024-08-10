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

        $query = Belanja::with('kendaraan', 'sukuCadangs');

        if ($dateRange) {
            $dates = explode(' - ', $dateRange);
            $startDate = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->startOfDay();
            $endDate = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->endOfDay();

            $query->whereBetween('tanggal_belanja', [$startDate, $endDate]);
        }

        $belanjas = $query->orderBy('created_at', 'desc')->get();

        $belanja_periode = $belanjas->sum('belanja_bahan_bakar_minyak')
            + $belanjas->sum('belanja_pelumas_mesin')
            + $belanjas->sum('belanja_suku_cadang');

        $belanja_bbm_periode = $belanjas->sum('belanja_bahan_bakar_minyak');
        $belanja_pelumas_periode = $belanjas->sum('belanja_pelumas_mesin');
        $belanja_suku_cadang_periode = $belanjas->sum('belanja_suku_cadang');

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
        $validatedData = $this->validateBelanja($request);

        // Check if at least one of BBM, Pelumas, or Suku Cadang is filled
        if (
            empty($validatedData['belanja_bahan_bakar_minyak']) &&
            empty($validatedData['belanja_pelumas_mesin']) &&
            empty(array_filter($validatedData['nama_suku_cadang'] ?? []))
        ) {
            return redirect()->back()->withErrors(['error' => 'Anda harus memilih setidaknya satu dari BBM, Pelumas, atau Suku Cadang.']);
        }

        $validatedData['tanggal_belanja'] = Carbon::createFromFormat('d/m/Y', $validatedData['tanggal_belanja'])->format('Y-m-d');

        DB::beginTransaction();
        try {
            $belanja = $this->createBelanja($validatedData);
            $this->createSukuCadangs($validatedData, $belanja);
            DB::commit();
            return redirect()->route('belanja.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
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
                        'stok_suku_cadang_id' => $sukuCadangId,
                        'jumlah' => $jumlah,
                        'harga_satuan' => $harga,
                    ]);
                    $sukuCadang->save();

                    // Update stok suku cadang
                    $stokSukuCadang->stok -= $jumlah;
                    $stokSukuCadang->save();
                }
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
        return view('belanja.show', compact('belanja'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $belanja = Belanja::with('sukuCadangs')->findOrFail($id);

        foreach ($belanja->sukuCadangs as $sukuCadang) {
            $stokSukuCadang = StokSukuCadang::findOrFail($sukuCadang->stok_suku_cadang_id);
            $stokSukuCadang->stok += $sukuCadang->jumlah;
            $stokSukuCadang->save();
            $sukuCadang->delete();
        }

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

    /**
     * Validate belanja data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function validateBelanja(Request $request)
    {
        return $request->validate([
            'group_anggaran_id' => 'required|integer',
            'kendaraan_id' => 'required|integer',
            'belanja_bahan_bakar_minyak' => 'nullable|integer|min:0',
            'belanja_pelumas_mesin' => 'nullable|integer|min:0',
            'tanggal_belanja' => 'required|date_format:d/m/Y',
            'keterangan' => 'nullable|string',
            'nama_suku_cadang' => 'nullable|array',
            'jumlah_suku_cadang' => 'nullable|array',
            'harga_suku_cadang' => 'nullable|array',
            'nama_suku_cadang.*' => 'nullable|integer',
            'jumlah_suku_cadang.*' => 'nullable|integer|min:1',
            'harga_suku_cadang.*' => 'nullable|integer|min:0',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'date_format' => 'Format tanggal harus :format.',
            'min' => 'Kolom :attribute minimal bernilai :min.',
        ]);
    }
}
