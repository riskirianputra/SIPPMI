<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BiayaSkema extends Model
{
    use SoftDeletes;

    public $table = 'biaya_skemas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'biaya_id',
        'persen_max',
        'persen_min',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function biayaSkemaPenelitianBiayas()
    {
        return $this->hasMany(PenelitianBiaya::class, 'biaya_skema_id', 'id');
    }

    public function biayaSkemaPengabdianBiayas()
    {
        return $this->hasMany(PengabdianBiaya::class, 'biaya_skema_id', 'id');
    }

    public function biaya()
    {
        return $this->belongsTo(KomponenBiaya::class, 'biaya_id');
    }
}
