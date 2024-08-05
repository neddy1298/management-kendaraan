<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaguAnggaran extends Model
{
    use HasFactory;

    protected $table = 'pagu_anggarans';

    protected $fillable = [
        'kode_rekening',
        'nama_rekening',
        'anggaran',
        'tahun',
    ];

    public function masterAnggaran()
    {
        return $this->hasMany(MasterAnggaran::class);
    }
}
