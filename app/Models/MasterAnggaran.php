<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAnggaran extends Model
{
    use HasFactory;

    protected $table = 'master_anggarans';

    protected $fillable = [
        'pagu_anggaran_id',
        'kode_rekening',
        'nama_rekening',
        'anggaran',
    ];

    public function paguAnggaran()
    {
        return $this->belongsTo(PaguAnggaran::class);
    }

    public function groupAnggarans()
    {
        return $this->hasMany(GroupAnggaran::class);
    }
}
