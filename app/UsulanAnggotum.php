<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsulanAnggotum extends Model
{

    //Konstanta Tipe
    const DOSEN = 1;
    const MAHASISWA = 2;

    //Konstanta Jabatan
    const KETUA = 1;
    const ANGGOTA = 2;


    const TIPE_SELECT = [
        self::DOSEN => 'Dosen',
        self::MAHASISWA => 'Mahasiswa'
    ];
    const JABATAN_SELECT = [
        self::KETUA => 'Ketua',
        self::ANGGOTA => 'Anggota',
    ];

    protected $table = 'usulan_anggota';

    public static $mahasiswa_validation_rule = [
        'nama'  => 'required',
        'identifier' => 'required',
        'unit' => 'required'
    ];

    public static $dosen_validation_rule = [
        'dosen_id'  => 'required'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    public function scopeTipe($query, $tipe)
    {
        return $query->where('tipe',$tipe);
    }

    public function getJabatanTextAttribute($value)
    {
        if($this->jabatan == 1){
            return 'Ketua';
        }else{
            return 'Anggota';
        }
    }

    public function getNamaAttribute($value)
    {
        if($this->tipe == self::DOSEN){
            return optional($this->dosen)->nama;
        }else{
            return $value;
        }
    }

    public function getNidnAttribute($value){
        if($this->tipe == self::DOSEN){
            return optional($this->dosen)->nidn;
        }else{
            return 'NIM:'.$this->identifier;
        }
    }
}
