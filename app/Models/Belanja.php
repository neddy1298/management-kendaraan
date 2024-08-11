<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Belanja extends Model
{
    use HasFactory;

    protected $table = 'belanjas';

    protected $fillable = [
        'group_anggaran_id',
        'kendaraan_id',
        'belanja_bahan_bakar_minyak',
        'belanja_pelumas_mesin',
        'belanja_suku_cadang',
        'tanggal_belanja',
        'keterangan',
    ];

    public function groupAnggaran()
    {
        return $this->belongsTo(GroupAnggaran::class, 'group_anggaran_id');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }

    public function totalBelanja()
    {
        return $this->belanja_bahan_bakar_minyak + $this->belanja_pelumas_mesin + $this->belanja_suku_cadang;
    }

    public function sukuCadangs()
    {
        return $this->hasMany(SukuCadang::class);
    }
}
