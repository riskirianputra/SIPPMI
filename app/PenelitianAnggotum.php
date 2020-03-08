<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenelitianAnggotum extends Model
{

    public $table = 'penelitian_anggota';

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

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'tipe',
        'jabatan',
        'dosen_id',
        'nama',
        'identifier',
        'unit',
        'created_at',
        'updated_at',
        'penelitian_id',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    public function penelitian()
    {
        return $this->belongsTo(Penelitian::class, 'penelitian_id');
    }


    // Atribut Turunan
    public function getNamaAttribute($value){
        $nama = "";
        switch ($this->tipe){
            case self::DOSEN:
                $nama = optional($this->dosen)->nama;
                break;
            case self::MAHASISWA:
                $nama = $this->nama;
                break;
        }
        return $nama;
    }

    public function getNidnAttribute($value){
        $nidn = "";
        switch ($this->tipe){
            case self::DOSEN:
                $nidn = optional($this->dosen)->nidn;
                break;
            case self::MAHASISWA:
                $nidn = "-";
                break;
        }
        return $nidn;
    }

    public function getNipAttribute($value){
        $nip = "";
        switch ($this->tipe){
            case self::DOSEN:
                $nip = optional($this->dosen)->nip;
                break;
            case self::MAHASISWA:
                $nip = $this->identifier;
                break;
        }
        return $nip;
    }

    public function getProdiAttribute($value){
        $prodi = "";
        switch ($this->tipe){
            case self::DOSEN:
                $prodi = optional($this->dosen->prodi)->nama;
                break;
            case self::MAHASISWA:
                $prodi = $this->unit;
                break;
        }
        return $prodi;
    }

    public function getJabatanTextAttribute($value){
        if(array_key_exists($this->jabatan, self::JABATAN_SELECT)){
            return self::JABATAN_SELECT[$this->jabatan];
        }
        return '';
    }
}
