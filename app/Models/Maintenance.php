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
        'belanja_bahan_bakar_minyak',
        'belanja_pelumas_mesin',
        'belanja_suku_cadang',
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

    public function totalMaintenance()
    {
        return $this->belanja_bahan_bakar_minyak + $this->belanja_pelumas_mesin + $this->belanja_suku_cadang;
    }

}
