<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaguAnggaran extends Model
{
    use HasFactory;

    protected $table = 'pagu_anggarans';

    protected $fillable = [
        'anggaran_perbulan_id',
        'kode_rekening',
        'nama_rekening',
        'anggaran',
        'tahun',
    ];

    public function anggaranPerbulan()
    {
        return $this->hasOne(AnggaranPerbulan::class);
    }

    public function masterAnggarans()
    {
        return $this->hasMany(MasterAnggaran::class);
    }
}
