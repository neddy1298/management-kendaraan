<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SukuCadang extends Model
{
    use HasFactory;

    protected $table = 'suku_cadangs';

    protected $fillable = [
        'belanja_id',
        'stok_suku_cadang_id',
        'nama_suku_cadang',
        'jumlah',
        'harga_satuan',
        'tanggal_belanja',
    ];

    public function belanja()
    {
        return $this->belongsTo(Belanja::class, 'belanja_id');
    }

    public function stokSukuCadang()
    {
        return $this->hasOne(StokSukuCadang::class, 'stok_suku_cadang_id');
    }
}
