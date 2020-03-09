<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RipTahapan extends Model
{
    use SoftDeletes;

    public $table = 'rip_tahapans';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'tahun',
        'bahasan',
        'created_at',
        'updated_at',
        'deleted_at',
        'sub_topik_id',
    ];

    public function tahapanPenelitians()
    {
        return $this->hasMany(Penelitian::class, 'tahapan_id', 'id');
    }

    public function sub_topik()
    {
        return $this->belongsTo(RipSubTopik::class, 'sub_topik_id');
    }
}
