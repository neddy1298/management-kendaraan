<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $table = 'maintenances';

    protected $fillable = [
        'kendaraan_id',
        'tanggal_maintenance',
        'keterangan',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function belanja()
    {
        return $this->hasMany(Belanja::class);
    }

    public function totalSemuaBelanja()
    {
        return $this->belanja->sum(function ($belanja) {
            return $belanja->totalBelanja();
        });
    }

    public function totalBelanjaBahanBakarMinyak()
    {
        return $this->belanja->sum('belanja_bahan_bakar_minyak');
    }

    public function totalBelanjaPelumasMesin()
    {
        return $this->belanja->sum('belanja_pelumas_mesin');
    }

    public function totalBelanjaSukuCadang()
    {
        return $this->belanja->sum('belanja_suku_cadang');
    }
}
