<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeRumpun extends Model
{
    public $table = 'kode_rumpuns';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'kode',
        'level',
        'created_at',
        'updated_at',
        'rumpun_ilmu',
    ];

    public function kodeRumpunPenelitians()
    {
        return $this->hasMany(Penelitian::class, 'kode_rumpun_id', 'id');
    }

    public function kodeRumpunPengabdians()
    {
        return $this->hasMany(Pengabdian::class, 'kode_rumpun_id', 'id');
    }
}
