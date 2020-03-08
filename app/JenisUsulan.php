<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisUsulan extends Model
{
    use SoftDeletes;

    public $table = 'jenis_usulans';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'kode',
        'nama',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function jenisUsulanRefSkemas()
    {
        return $this->hasMany(RefSkema::class, 'jenis_usulan_id', 'id');
    }

    public function jenisUsulanOutputs()
    {
        return $this->hasMany(Output::class, 'jenis_usulan_id', 'id');
    }
}
