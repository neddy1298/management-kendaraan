<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAnggaran extends Model
{
    use HasFactory;

    protected $table = 'tbl_master_anggaran';

    protected $fillable = [
        'kode_rekening',
        'nama_rekening',
        'anggaran'
    ];

    public function anggaran()
    {
        return $this->hasMany(Anggaran::class, 'id_master_anggaran');
    }
}
