<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengabdianBiaya extends Model
{
    use SoftDeletes;

    public $table = 'pengabdian_biayas';

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
        'pengabdian_id',
        'biaya_skema_id',
        'harga_satuan_final',
    ];

    public function biaya_skema()
    {
        return $this->belongsTo(BiayaSkema::class, 'biaya_skema_id');
    }

    public function pengabdian()
    {
        return $this->belongsTo(Pengabdian::class, 'pengabdian_id');
    }
}
