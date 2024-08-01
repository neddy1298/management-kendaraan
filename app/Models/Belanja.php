<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Belanja extends Model
{
    use HasFactory;

    protected $table = 'belanjas';

    protected $fillable = [
        'maintenance_id',
        'belanja_bahan_bakar_minyak',
        'belanja_pelumas_mesin',
        'belanja_suku_cadang',
        'tanggal_belanja',
        'keterangan',
    ];

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }

    public function totalBelanja()
    {
        return $this->belanja_bahan_bakar_minyak + $this->belanja_pelumas_mesin + $this->belanja_suku_cadang;
    }

    

}
