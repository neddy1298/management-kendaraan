<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'tbl_desa';

    protected $primaryKey = 'kode_desa';

    protected $fillable = [
        'kode_desa',
        'nama_desa',
        'kode_kecamatan',
        'nama_kecamatan',
        'kode_kabupaten',
        'nama_kabupaten',
        'kode_provinsi',
        'nama_provinsi',
        'alamat_kantor',
        'telepon',
        'email',
        'kode_pos',
        'nama_kepala_desa',
        'nip_kepala_desa',
        'nama_sekretaris_desa',
        'nip_sekretaris_desa',
        'nama_bendahara_desa',
        'created_at',
        'updated_at',
    ];
}
