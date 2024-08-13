<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupAnggaran extends Model
{
    use HasFactory;

    protected $table = 'group_anggarans';

    protected $fillable = [
        'master_anggaran_id',
        'anggaran_perbulan_id',
        'kode_rekening',
        'nama_group',
        'anggaran_bahan_bakar_minyak',
        'anggaran_pelumas_mesin',
        'anggaran_suku_cadang',
    ];

    public function anggaranPerbulan()
    {
        return $this->hasOne(AnggaranPerbulan::class);
    }

    public function kendaraans()
    {
        return $this->belongsToMany(Kendaraan::class, 'group_anggaran_kendaraan');
    }

    public function belanjas()
    {
        return $this->hasMany(Belanja::class);
    }

    public function masterAnggaran()
    {
        return $this->belongsTo(MasterAnggaran::class);
    }

    protected $appends = ['total_anggaran'];

    public function getTotalAnggaranAttribute()
    {
        return $this->anggaran_bahan_bakar_minyak + $this->anggaran_pelumas_mesin + $this->anggaran_suku_cadang;
    }
}
