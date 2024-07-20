<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $table = 'tbl_penduduk';

    protected $primaryKey = 'nik';

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    protected $fillable = [
        'nik',
        'nkk',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'rt',
        'rw',
        'kelurahan_desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'agama',
        'status',
        'pekerjaan',
        'kewarganegaraan',
        'updated_at',
        'created_at',
    ];

    public function kepalaKeluarga()
    {
        return $this->belongsTo(KepalaKeluarga::class, 'nkk', 'nkk');
    }

}
