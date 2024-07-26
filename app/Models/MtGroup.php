<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtGroup extends Model
{
    use HasFactory;

    protected $table = 'tbl_mt_group';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_group',
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
        return $this->hasOne(Maintenance::class, 'mt_group', 'id');
    }

    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class, 'mt_group', 'id');
    }
}
