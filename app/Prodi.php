<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    public $table = 'prodis';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'nama',
        'kode',
        'kode_dikti',
        'akreditasi',
        'created_at',
        'updated_at',
        'deleted_at',
        'fakultas_id',
    ];

    public function prodiPenelitians()
    {
        return $this->hasMany(Penelitian::class, 'prodi_id', 'id');
    }

    public function prodiPengabdians()
    {
        return $this->hasMany(Pengabdian::class, 'prodi_id', 'id');
    }

    public function prodiDosens()
    {
        return $this->hasMany(Dosen::class, 'prodi_id', 'id');
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultum::class, 'fakultas_id');
    }


    public function getFakultasProdiAttribute($value){
        return $this->fakultas->nama.' - '.$this->nama;
    }
}
