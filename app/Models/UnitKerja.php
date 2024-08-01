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
        'group_anggaran_id',
        'budget_bahan_bakar_minyak',
        'budget_pelumas_mesin',
        'budget_suku_cadang',
    ];

    public function kendaraans()
    {
        return $this->hasMany(Kendaraan::class);
    }

    public function groupAnggaran()
    {
        return $this->belongsTo(GroupAnggaran::class);
    }

    public function totalBudget()
    {
        return $this->budget_bahan_bakar_minyak + $this->budget_pelumas_mesin + $this->budget_suku_cadang;
    }
    
}
