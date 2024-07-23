<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'tbl_kendaraan';

    // Correct relationship method name
    public function maintenance()
    {
        return $this->hasOne(Maintenance::class, 'nomor_registrasi', 'nomor_registrasi');
    }
}