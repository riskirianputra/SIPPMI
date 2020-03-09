<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RipSubTema extends Model
{
    use SoftDeletes;

    public $table = 'rip_sub_temas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama',
        'tema_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function subtemaRipTopiks()
    {
        return $this->hasMany(RipTopik::class, 'subtema_id', 'id');
    }

    public function tema()
    {
        return $this->belongsTo(RipTema::class, 'tema_id');
    }
}
