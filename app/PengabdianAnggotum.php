<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengabdianAnggotum extends Model
{
    use SoftDeletes;

    public $table = 'pengabdian_anggota';

    const JABATAN_SELECT = [
        '1' => 'Ketua',
        '2' => 'Anggota',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'jabatan',
        'dosen_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'pengabdian_id',
    ];

    public function pengabdian()
    {
        return $this->belongsTo(Pengabdian::class, 'pengabdian_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
}
