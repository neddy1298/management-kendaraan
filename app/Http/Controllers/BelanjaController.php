<?php

namespace App\Http\Controllers;

use App\Models\Belanja;
use App\Models\GroupAnggaran;
use App\Models\GroupAnggaranKendaraan;
use App\Models\Kendaraan;
use App\Models\StokSukuCadang;
use App\Models\SukuCadang;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BelanjaController extends Controller
{

    public function index(Request $request)
    {
        $dateRange = $request->input('date-range');
        $search = $request->input('search');

        $query = Belanja::with('kendaraan', 'sukuCadangs');

        if ($dateRange) {
            $dates = explode(' - ', $dateRange);
            $startDate = Carbon::createFromFormat('d/m/Y', trim($dates[0]))->startOfDay();
            $endDate = Carbon::createFromFormat('d/m/Y', trim($dates[1]))->endOfDay();

            $query->whereBetween('tanggal_belanja', [$startDate, $endDate]);
        }
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('keterangan', 'LIKE', "%{$search}%")
                    ->orWhere('tanggal_belanja', 'LIKE', "%{$search}%")
                    ->orWhere('total_belanja', 'LIKE', "%{$search}%")
                    ->orWhereHas('kendaraan', function ($q) use ($search) {
                        $q->where('nomor_registrasi', 'LIKE', "%{$search}%");
                    });
            });
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

        $belanjas = $query->orderBy('created_at', 'desc')->paginate(20);


        return view('belanja.index', compact('belanjas', 'isExpire', 'belanja_periode', 'belanja_bbm_periode', 'belanja_pelumas_periode', 'belanja_suku_cadang_periode', 'dateRange', 'search'));
    }

    public function create()
    {
        $kendaraans = Kendaraan::orderBy('nomor_registrasi')->get();
        $groupAnggarans = GroupAnggaran::orderBy('kode_rekening')->get();
        $stokSukuCadangs = StokSukuCadang::with('groupAnggaran')->orderBy('group_anggaran_id')->get();
        return view('belanja.create', compact('kendaraans', 'groupAnggarans', 'stokSukuCadangs'));
    }

    public function getGroupAnggaran($kendaraanId)
    {
        $groupAnggarans = GroupAnggaranKendaraan::where('kendaraan_id', $kendaraanId)
            ->join('group_anggarans', 'group_anggaran_kendaraan.group_anggaran_id', '=', 'group_anggarans.id')
            ->select('group_anggarans.id', 'group_anggarans.kode_rekening', 'group_anggarans.nama_group')
            ->get();
        return response()->json($groupAnggarans);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateBelanja($request);

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
            'belanja_suku_cadang' => array_sum($data['harga_suku_cadang'] ?? []),
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
                        'nama_suku_cadang' => $stokSukuCadang->nama_suku_cadang,
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

    public function show(Belanja $belanja)
    {
        return view('belanja.show', compact('belanja'));
    }

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
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

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
