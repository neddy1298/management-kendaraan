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

    public function relatedGroupAnggarans()
    {
        return $this->belongsToMany(GroupAnggaran::class, 'group_anggaran_relations', 'group_anggaran_id', 'related_group_anggaran_id');
    }

    public function masterAnggaran()
    {
        return $this->belongsTo(MasterAnggaran::class);
    }

    public function unitKerjas()
    {
        return $this->belongsToMany(UnitKerja::class, 'group_anggaran_unit_kerja');
    }

    protected $appends = ['total_anggaran'];

    public function getTotalAnggaranAttribute()
    {
        return $this->anggaran_bahan_bakar_minyak + $this->anggaran_pelumas_mesin + $this->anggaran_suku_cadang;
    }
}
