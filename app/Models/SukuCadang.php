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
        'jumlah',
        'harga_satuan',
    ];

    public function belanja()
    {
        return $this->belongsTo(Belanja::class);
    }

    public function stokSukuCadang()
    {
        return $this->hasOne(StokSukuCadang::class);
    }
}
