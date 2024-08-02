<?php

namespace App\Http\Controllers;

use App\Models\Belanja;
use App\Models\Kendaraan;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BelanjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $belanjas = Belanja::all();
        return view('belanja.index', compact('belanjas'));
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
            'belanja_bahan_bakar_minyak' => 'required_without_all:belanja_pelumas_mesin,belanja_suku_cadang|nullable|integer',
            'belanja_pelumas_mesin' => 'required_without_all:belanja_bahan_bakar_minyak,belanja_suku_cadang|nullable|integer',
            'belanja_suku_cadang' => 'required_without_all:belanja_bahan_bakar_minyak,belanja_pelumas_mesin|nullable|integer',
            'tanggal_belanja' => 'required|string|date_format:d/m/Y',
            'keterangan' => 'required|string|max:255',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'required_without_all' => 'Minimal salah satu kolom :attribute harus diisi.',
            'date_format' => 'Format tanggal harus :format.',
        ]);

        // Convert date format from d/m/Y to Y-m-d for consistency
        $validatedData['tanggal_belanja'] = Carbon::createFromFormat('d/m/Y', $validatedData['tanggal_belanja'])->format('Y-m-d');

        try {
            $maintenance = Maintenance::find($validatedData['maintenance_id']);
            $maintenanceMonth = Carbon::createFromFormat('Y-m-d', $maintenance->tanggal_maintenance)->format('Y-m');
            $belanjaMonth = Carbon::createFromFormat('Y-m-d', $validatedData['tanggal_belanja'])->format('Y-m');
            $otherMaintenances = Maintenance::where('kendaraan_id', $maintenance->kendaraan_id)
                ->where('id', '!=', $maintenance->id)
                ->get();
            
            if ($maintenanceMonth == $belanjaMonth) {
                $maintenance->update([
                    'tanggal_maintenance' => $validatedData['tanggal_belanja'],
                    'updated_at' => Carbon::now(),
                    'keterangan' => $maintenance->keterangan . ' ' . $validatedData['keterangan'],
                ]);
            } elseif ($otherMaintenances->count() > 0) {
                $found = false;
                foreach ($otherMaintenances as $otherMaintenance) {
                    $otherMaintenanceMonth = Carbon::createFromFormat('Y-m-d', $otherMaintenance->tanggal_maintenance)->format('Y-m');
                    if ($otherMaintenanceMonth == $belanjaMonth) {
                        $otherMaintenance->update([
                            'tanggal_maintenance' => $validatedData['tanggal_belanja'],
                            'updated_at' => Carbon::now(),
                            'keterangan' => $otherMaintenance->keterangan . ' ' . $validatedData['keterangan'],
                        ]);
                        $validatedData['maintenance_id'] = $otherMaintenance->id;
                        $found = true;
                        break;
                    } 
                }
                if (!$found) {
                    $new_maintenance = Maintenance::create([
                        'kendaraan_id' => $maintenance->kendaraan_id,
                        'tanggal_maintenance' => $validatedData['tanggal_belanja'],
                        'keterangan' => $validatedData['keterangan'],
                    ]);
            
                    $validatedData['maintenance_id'] = $new_maintenance->id;
                }
            } else {
                $new_maintenance = Maintenance::create([
                    'kendaraan_id' => $maintenance->kendaraan_id,
                    'tanggal_maintenance' => $validatedData['tanggal_belanja'],
                    'keterangan' => $validatedData['keterangan'],
                ]);
            
                $validatedData['maintenance_id'] = $new_maintenance->id;
            }
            // dd($maintenance_before,$maintenance, $new_maintenance);

            Belanja::create($validatedData);

            return redirect()->route('belanja.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->route('belanja.index')->with('error', 'Terjadi kesalahan saat menyimpan data.');
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
        $belanja = Belanja::find($id);
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
        $datas = Belanja::all();
        return view('belanja.printAll', compact('datas'));
    }
}
