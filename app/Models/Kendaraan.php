<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'tbl_kendaraan';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nik',
        'jenis_permohonan',
        'keterangan',
        'updated_at',
        'created_at',
    ];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'nik', 'nik');
    }

    public function kepalaKeluarga()
    {
        return $this->belongsTo(KepalaKeluarga::class, 'nkk', 'nkk');
    }
}
