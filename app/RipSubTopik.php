<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RipSubTopik extends Model
{
    use SoftDeletes;

    public $table = 'rip_sub_topiks';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama',
        'luaran',
        'topik_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function subTopikRipTahapans()
    {
        return $this->hasMany(RipTahapan::class, 'sub_topik_id', 'id');
    }

    public function topik()
    {
        return $this->belongsTo(RipTopik::class, 'topik_id');
    }
}
