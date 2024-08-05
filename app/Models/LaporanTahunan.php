<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanTahunan extends Model
{
    use HasFactory;

    protected $table = 'laporan_tahunans';

    protected $fillable = [
        'pagu_anggaran_id',
        'tahun',
    ];

    public function masterAnggaran()
    {
        return $this->hasMany(MasterAnggaran::class);
    }

    public function laporanBulanans()
    {
        return $this->hasMany(LaporanBulanan::class);
    }

    public function totalSemuaLaporanBulanan()
    {
        return $this->laporanBulanans->sum(function ($laporanBulanan) {
            return $laporanBulanan->totalSemuaMaintenance();
        });
    }

    public function totalSemuaMaintenance()
    {
        return $this->laporanBulanans->sum(function ($laporanBulanan) {
            return $laporanBulanan->totalSemuaMaintenance();
        });
    }

    public function totalBelanjaBahanBakarMinyak()
    {
        return $this->laporanBulanans->sum(function ($laporanBulanan) {
            return $laporanBulanan->totalBelanjaBahanBakarMinyak();
        });
    }

    public function totalBelanjaPelumasMesin()
    {
        return $this->laporanBulanans->sum(function ($laporanBulanan) {
            return $laporanBulanan->totalBelanjaPelumasMesin();
        });
    }

    public function totalBelanjaSukuCadang()
    {
        return $this->laporanBulanans->sum(function ($laporanBulanan) {
            return $laporanBulanan->totalBelanjaSukuCadang();
        });
    }
}
