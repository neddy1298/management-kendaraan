<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;

    protected $table = 'tbl_unit_kerja';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_unit_kerja',
        'bahan_bakar_minyak',
        'pelumas_mesin',
        'suku_cadang',
        'budget_bahan_bakar_minyak',
        'budget_pelumas_mesin',
        'budget_suku_cadang',
        '_token',
        'created_at',
        'updated_at',
    ];

    public function maintenance()
    {
        return $this->hasOne(Maintenance::class, 'unit_kerja', 'id');
    }

    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class, 'unit_kerja', 'id');
    }
}
