<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokSukuCadang extends Model
{
    use HasFactory;

    protected $table = 'stok_suku_cadangs';

    protected $fillable = [
        'id_suku_cadang',
        'nama_suku_cadang',
        'group_anggaran',
        'stok_awal',
        'stok',
        'harga',
    ];

    public function sukuCadang()
    {
        return $this->hasMany(SukuCadang::class);
    }
}
