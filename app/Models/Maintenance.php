<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $table = 'tbl_maintenance';

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'nomor_registrasi', 'nomor_registrasi');
    }

    public function mtGroup()
    {
        return $this->belongsTo(MtGroup::class, 'id', 'mt_group');
    }
}