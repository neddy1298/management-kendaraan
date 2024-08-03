<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
    protected $dates = ['berlaku_sampai'];

    protected $casts = [
        'berlaku_sampai' => 'datetime',
    ];

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class);
    }

    protected $appends = ['isExpire'];

    public function getIsExpireAttribute()
    {
        if ($this->berlaku_sampai->isPast()) {
            return 'kadaluarsa';
        } else {
            return 'aktif';
        }
    }
}
