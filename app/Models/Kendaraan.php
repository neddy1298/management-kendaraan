<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraans';

    protected $fillable = [
        'unit_kerja_id',
        'nomor_registrasi',
        'merk_kendaraan',
        'jenis_kendaraan',
        'cc_kendaraan',
        'bbm_kendaraan',
        'roda_kendaraan',
        'berlaku_sampai',
    ];

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }

    public function maintenance()
    {
        return $this->hasOne(Maintenance::class);
    }

}
