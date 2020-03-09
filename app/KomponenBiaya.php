<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KomponenBiaya extends Model
{
    use SoftDeletes;

    public $table = 'komponen_biayas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama',
        'keterangan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function biayaBiayaSkemas()
    {
        return $this->hasMany(BiayaSkema::class, 'biaya_id', 'id');
    }
}
