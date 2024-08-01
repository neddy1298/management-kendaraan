<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAnggaran extends Model
{
    use HasFactory;

    protected $table = 'master_anggarans';

    protected $fillable = [
        'kode_rekening',
        'nama_rekening',
        'anggaran',
    ];

    public function groupAnggaran()
    {
        return $this->hasMany(GroupAnggaran::class);
    }
}
