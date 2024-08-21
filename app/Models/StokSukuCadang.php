<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokSukuCadang extends Model
{
    use HasFactory;

    protected $table = 'stok_suku_cadangs';

    protected $fillable = [
        'nama_suku_cadang',
        'group_anggaran_id',
        'stok_awal',
        'stok',
        'harga',
    ];

    public function sukuCadangs()
    {
        return $this->hasMany(SukuCadang::class);
    }

    public function groupAnggaran()
    {
        return $this->hasOne(GroupAnggaran::class, 'id', 'group_anggaran_id');
    }
}
