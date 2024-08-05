<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBulanan extends Model
{
    use HasFactory;

    protected $table = 'laporan_bulanans';

    protected $fillable = [
        'laporan_tahunan_id',
        'bulan',
        'realisasi_bahan_bakar_minyak',
        'realisasi_pelumas_mesin',
        'realisasi_suku_cadang',
    ];

    public function laporanTahunan()
    {
        return $this->belongsTo(LaporanTahunan::class);
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function totalSemuaMaintenance()
    {
        return $this->maintenance->sum(function ($maintenance) {
            return $maintenance->totalSemuaBelanja();
        });
    }

    public function totalBelanjaBahanBakarMinyak()
    {
        return $this->maintenance->sum(function ($maintenance) {
            return $maintenance->totalBelanjaBahanBakarMinyak();
        });
    }

    public function totalBelanjaPelumasMesin()
    {
        return $this->maintenance->sum(function ($maintenance) {
            return $maintenance->totalBelanjaPelumasMesin();
        });
    }

    public function totalBelanjaSukuCadang()
    {
        return $this->maintenance->sum(function ($maintenance) {
            return $maintenance->totalBelanjaSukuCadang();
        });
    }
}
