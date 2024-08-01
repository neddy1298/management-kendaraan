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
        'kode_rekening',
        'nama_group',
        'anggaran_bahan_bakar_minyak',
        'anggaran_pelumas_mesin',
        'anggaran_suku_cadang',
    ];

    public function masterAnggaran()
    {
        return $this->belongsTo(MasterAnggaran::class);
    }

    public function unitKerja()
    {
        return $this->hasMany(UnitKerja::class);
    }

    public function totalAnggaran()
    {
        return $this->anggaran_bahan_bakar_minyak + $this->anggaran_pelumas_mesin + $this->anggaran_suku_cadang;
    }
}
