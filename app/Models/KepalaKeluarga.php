<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepalaKeluarga extends Model
{
    use HasFactory;

    protected $table = 'tbl_kepala_keluarga';

    protected $primaryKey = 'nkk';

    protected $fillable = [
        'nkk',
        'nama_kepala_keluarga',
        'rt',
        'rw',
        'alamat',
        'updated_at',
        'created_at',
    ];
}
