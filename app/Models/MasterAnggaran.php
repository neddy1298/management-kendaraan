<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAnggaran extends Model
{
    use HasFactory;

    protected $table = 'master_anggarans';

    protected $fillable = [
        'pagu_anggaran_id',
        'anggaran_perbulan_id',
        'kode_rekening',
        'nama_rekening',
        'anggaran',
    ];

    public function anggaranPerbulan()
    {
        return $this->hasOne(AnggaranPerbulan::class);
    }

    public function paguAnggaran()
    {
        return $this->belongsTo(PaguAnggaran::class);
    }

    public function groupAnggarans()
    {
        return $this->hasMany(GroupAnggaran::class);
    }

    public function getBelanjasSumForDateRange($startDate, $endDate)
    {
        return $this->groupAnggarans->sum(function ($groupAnggaran) use ($startDate, $endDate) {
            return $groupAnggaran->belanjas()
                ->whereBetween('tanggal_belanja', [$startDate, $endDate])
                ->sum('total_belanja');
        });
    }

    public function getBelanjasSumBeforeDate($endDate)
    {
        return $this->groupAnggarans->sum(function ($groupAnggaran) use ($endDate) {
            return $groupAnggaran->belanjas()
                ->where('tanggal_belanja', '<', $endDate)
                ->sum('total_belanja');
        });
    }
}
