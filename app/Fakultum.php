<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fakultum extends Model
{
    public $table = 'fakultas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'nama',
        'kode',
        'singkatan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function fakultasProdis()
    {
        return $this->hasMany(Prodi::class, 'fakultas_id', 'id');
    }
}
