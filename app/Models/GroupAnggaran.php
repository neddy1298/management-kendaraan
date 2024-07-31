<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupAnggaran extends Model
{
    use HasFactory;

    protected $table = 'tbl_group_anggaran';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_master_anggaran',
        'kode_rekening',
        'nama_group',
        'anggaran_bensin_pelumas',
        'anggaran_suku_cadang',
        'keterangan',
    ];

    public function masterAnggaran()
    {
        return $this->belongsTo(MasterAnggaran::class, 'id_master_anggaran', 'id');
    }
}
