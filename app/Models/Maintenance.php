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
        'mt_group',
        'belanja_bahan_bakar_minyak',
        'belanja_pelumas_mesin',
        'belanja_suku_cadang',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'nomor_registrasi', 'nomor_registrasi');
    }

    public function mtGroup()
    {
        return $this->belongsTo(MtGroup::class, 'mt_group', 'id');
    }

    public function belanja()
    {
        return $this->hasMany(Belanja::class, 'nomor_registrasi', 'nomor_registrasi');
    }
}
