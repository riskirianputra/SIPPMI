<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RipTopik extends Model
{
    use SoftDeletes;

    public $table = 'rip_topiks';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama',
        'luaran',
        'subtema_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function topikRipSubTopiks()
    {
        return $this->hasMany(RipSubTopik::class, 'topik_id', 'id');
    }

    public function subtema()
    {
        return $this->belongsTo(RipSubTema::class, 'subtema_id');
    }
}
