<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtGroup extends Model
{
    use HasFactory;

    protected $table = 'tbl_mt_group';

    public function maintenance()
    {
        return $this->hasOne(Maintenance::class, 'mt_group', 'id');
    }
}
