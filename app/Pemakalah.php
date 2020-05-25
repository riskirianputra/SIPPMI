<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pemakalah extends Model
{
    public $table = 'pemakalahs';
    protected $guarded = [];

    const DRAFT = 0;
    const UNVERIFIED = 1;
    const VERIFIKASI_OK = 2;
    const VERIFIKASI_NOK = 3;

    const STATUSES = [
        self::DRAFT => 'Draft',
        self::UNVERIFIED => 'Belum Verifikasi',
        self::VERIFIKASI_OK => 'Verified',
        self::VERIFIKASI_NOK => 'Tidak Terverifikasi',
    ];

    const PEMAKALAH = 1;
    const KEYNOTE_SPEAKER = 2;
    const STATUS_PEMAKALAH = [
        self::PEMAKALAH => 'Pemakalah Biasa',
        self::KEYNOTE_SPEAKER => 'Invited/Keynote Speaker',
    ];

    const LEVEL_INTERNATIONAL = 1;
    const LEVEL_NATIONAL = 2;
    const LEVEL_REGIONAL = 3;
    const LEVELS = [
        self::LEVEL_INTERNATIONAL => 'Tingkat International',
        self::LEVEL_NATIONAL => 'Tingkat Nasional',
        self::LEVEL_REGIONAL => 'Tingkat Regional',
    ];

    /** RELATIONSHIP */
    public function usulan()
    {
        return $this->belongsTo(Usulan::class, 'id', 'id');
    }

    public function authors()
    {
        return $this->hasManyThrough(UsulanAnggotum::class, Usulan::class, 'id', 'usulan_id', 'id', 'id');
    }

    public function author_dosens()
    {
        return $this->hasManyThrough(UsulanAnggotum::class, Usulan::class, 'id', 'usulan_id', 'id', 'id')
            ->where('jabatan', 2)->where('tipe', 1);
    }

    public function author_mahasiswas()
    {
        return $this->hasManyThrough(UsulanAnggotum::class, Usulan::class, 'id', 'usulan_id', 'id', 'id')
            ->where('jabatan', 2)->where('tipe', 2);
    }

    /** FUNCTION */
    public function getFileArtikelUrl()
    {
        $folder = config('sippmi.path.kinerja.makalah');
        $path = Storage::url($folder . '/' . $this->file_artikel);
        return $path;
    }

    /** EXTENDED ATTRIBUTE */
    public function getOwnerAttribute($value)
    {
        return $this->usulan->pengusul_id;
    }

    public function getJudulSimpleAttribute($value){
        $judul = str_replace('<p>', '', $this->judul);
        $judul = str_replace('</p>', '', $judul);
        return $judul;
    }

    public function getJudulTextAttribute($value)
    {
        return strip_tags($this->judul);
    }

    public function getStatusPemakalahTextAttribute($value)
    {
        return data_get(self::STATUS_PEMAKALAH, $this->status_pemakalah, '-');
    }

    public function getFirstAuthorAttribute($value)
    {
        return $this->authors->where('jabatan', UsulanAnggotum::PENULIS_PERTAMA)->first();
    }
}
