<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $table = 'tbl_maintenance';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nomor_registrasi',
        'unit_kerja',
        'belanja_bahan_bakar_minyak',
        'belanja_pelumas_mesin',
        'belanja_suku_cadang',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'nomor_registrasi', 'nomor_registrasi');
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja', 'id');
    }

    public function belanja()
    {
        return $this->hasMany(Belanja::class, 'nomor_registrasi', 'nomor_registrasi');
    }
}
