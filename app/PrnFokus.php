<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrnFokus extends Model
{
    public $table = 'prn_fokuses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
