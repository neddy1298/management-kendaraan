<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupAnggaranKendaraan extends Model
{
    use HasFactory;

    protected $table = 'group_anggaran_kendaraan';

    protected $fillable = [
        'group_anggaran_id',
        'kendaraan_id',
    ];

    public function groupAnggaran()
    {
        return $this->belongsTo(GroupAnggaran::class);
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
