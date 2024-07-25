<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Belanja extends Model
{
    use HasFactory;

    protected $table = 'tbl_belanja';

    protected $fillable = [
        'nomor_registrasi',
        'belanja_bahan_bakar_minyak',
        'belanja_pelumas_mesin',
        'belanja_suku_cadang',
        'tanggal_belanja',
        'keterangan'
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'nomor_registrasi', 'nomor_registrasi');
    }
}
