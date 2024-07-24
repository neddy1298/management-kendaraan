<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $table = 'tbl_maintenance';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nomor_registrasi',
        'mt_group',
        '_token',
        'created_at',
        'updated_at',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'nomor_registrasi', 'nomor_registrasi');
    }

    public function mtGroup()
    {
        return $this->belongsTo(MtGroup::class, 'id', 'mt_group');
    }
}