<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'tbl_kendaraan';

    protected $primaryKey = 'nomor_registrasi';

    protected $fiillable = [
        'nomor_registrasi',
        'merk_kendaraan',
        'jenis_kendaraan',
        'cc_kendaraan',
        'bbm_kendaraan',
        'roda_kendaraan',
        'berlaku_sampai',
        'created_at',
        'updated_at',
        '_token',
    ];

    // Correct relationship method name
    public function maintenance()
    {
        return $this->hasOne(Maintenance::class, 'nomor_registrasi', 'nomor_registrasi');
    }
}