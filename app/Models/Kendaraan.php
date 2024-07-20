<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'tbl_kendaraan';

    protected $primaryKey = 'id';

    protected $fillable = [
        'plat_nomor',
        'jumlah_roda',
        'keterangan',
        'updated_at',
        'created_at',
    ];
}
