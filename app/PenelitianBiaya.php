<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenelitianBiaya extends Model
{
    use SoftDeletes;

    public $table = 'penelitian_biayas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'jumlah',
        'satuan',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'justifikasi',
        'jumlah_final',
        'harga_satuan',
        'penelitian_id',
        'biaya_skema_id',
        'harga_satuan_final',
    ];

    public function biaya_skema()
    {
        return $this->belongsTo(BiayaSkema::class, 'biaya_skema_id');
    }

    public function penelitian()
    {
        return $this->belongsTo(Penelitian::class, 'penelitian_id');
    }
}
