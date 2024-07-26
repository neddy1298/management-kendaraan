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
        'nomor_registrasi',
        'merk_kendaraan',
        'jenis_kendaraan',
        'cc_kendaraan',
        'bbm_kendaraan',
        'roda_kendaraan',
        'berlaku_sampai',
    ];

    public function maintenance()
    {
        return $this->hasOne(Maintenance::class, 'nomor_registrasi', 'nomor_registrasi');
    }

    public function belanja()
    {
        return $this->hasMany(Belanja::class, 'nomor_registrasi', 'nomor_registrasi');
    }
}
