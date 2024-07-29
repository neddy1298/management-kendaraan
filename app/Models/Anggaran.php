<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    use HasFactory;

    protected $table = 'tbl_anggaran';

    protected $fillable = [
        'id_master_anggaran',
        'kode_rekening',
        'nama_rekening',
        'anggaran'
    ];

    public function masterAnggaran()
    {
        return $this->belongsTo(MasterAnggaran::class, 'id');

    }
}
