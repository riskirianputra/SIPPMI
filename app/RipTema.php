<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RipTema extends Model
{
    use SoftDeletes;

    public $table = 'rip_temas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama',
        'status',
        'luaran',
        'periode',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function temaRipSubTemas()
    {
        return $this->hasMany(RipSubTema::class, 'tema_id', 'id');
    }
}
