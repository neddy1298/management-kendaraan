<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;

    protected $table = 'unit_kerjas';

    protected $fillable = [
        'nama_unit_kerja',
    ];

    public function kendaraans()
    {
        return $this->hasMany(Kendaraan::class);
    }

    public function groupAnggarans()
    {
        return $this->belongsToMany(GroupAnggaran::class, 'group_anggaran_unit_kerja');
    }
}
