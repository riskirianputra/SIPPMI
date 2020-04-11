<?php

namespace App;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Pengabdian extends Model
{
    use SoftDeletes;

    public $table = 'pengabdians';

    const MULTI_TAHUN_SELECT = [
        '1' => 'Ya',
        '0' => 'Tidak',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $guarded = [];

    public function ketua()
    {
        return $this->hasManyThrough(UsulanAnggotum::class, Usulan::class, 'id', 'usulan_id', 'id', 'id')
            ->where('jabatan', 1);
    }

    public function anggota_dosens()
    {
        return $this->hasManyThrough(UsulanAnggotum::class, Usulan::class, 'id', 'usulan_id', 'id', 'id')
            ->where('jabatan', 2)->where('tipe', 1);
    }

    public function reviewers()
    {
        return $this->hasMany(Review::class, 'usulan_id', 'id');
    }

    public function anggota_mahasiswas()
    {
        return $this->hasManyThrough(UsulanAnggotum::class, Usulan::class, 'id', 'usulan_id', 'id', 'id')
            ->where('jabatan', 2)->where('tipe', 2);
    }

    /** LEGACY CODE */

    public function anggotas()
    {
        return $this->hasManyThrough(UsulanAnggotum::class, Usulan::class, 'id', 'usulan_id', 'id', 'id');
    }

    public function usulan()
    {
        return $this->belongsTo(Usulan::class, 'id', 'id');
    }

    public function usulanAnggotumWithPengabdianId()
    {
        return $this->hasMany(UsulanAnggotum::class, 'usulan_id', 'pengabdian_id');
    }


    public function pengabdianPengabdianOutputs()
    {
        return $this->hasMany(PengabdianOutput::class, 'pengabdian_id', 'id');
    }

    public function pengabdianPengabdianBiayas()
    {
        return $this->hasMany(PengabdianBiaya::class, 'pengabdian_id', 'id');
    }

    public function skema()
    {
        return $this->belongsTo(RefSkema::class, 'skema_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function hasKomentar()
    {
        $komentars = optional($this->komentars)->where('status', 0)->count();
        if($komentars > 0){
            return true;
        }else{
            return false;
        }
    }

    public function komentars()
    {
        return $this->hasManyThrough(UsulanKomentar::class, Usulan::class, 'id', 'usulan_id', 'id', 'id');
    }

    public function kode_rumpun()
    {
        return $this->belongsTo(KodeRumpun::class, 'kode_rumpun_id');
    }

    public function getFileProposalPath()
    {
        $folder = config('sippmi.path.proposal');
        $path = Storage::url($folder.'/'.$this->file_proposal);
        return $path;
    }

    public function getFilePengesahanPath()
    {
        $folder = config('sippmi.path.pengesahan');
        $path = Storage::url($folder.'/'.$this->file_pengesahan);
        return $path;
    }

    public function getFileCvPath()
    {
        $folder = config('sippmi.path.cv');
        $path = Storage::url($folder.'/'.$this->file_cv);
        return $path;
    }

    public function getFileProposalUrl()
    {
        $folder = config('sippmi.path.proposal');
        $path = Storage::url($folder.'/'.$this->file_proposal);
        return $path;
    }

    public function getFilePengesahanUrl()
    {
        $folder = config('sippmi.path.pengesahan');
        $path = Storage::url($folder.'/'.$this->file_pengesahan);
        return $path;
    }

    public function getFileCvUrl()
    {
        $folder = config('sippmi.path.cv');
        $path = Storage::url($folder.'/'.$this->file_cv);
        return $path;
    }

    public function getOwnerAttribute($value)
    {
        return $this->usulan->pengusul_id;
    }

    public function getStatusTextAttribute($value)
    {
        $status = 'DRAFT';
        switch(optional($this->usulan)->status_usulan){
            case 0 :
                $status = "DRAFT";
                break;
            case 1 :
                $status = 'SUBMITTED';
                break;
            case 2:
                $status = 'REVIEWING';
                break;
            case 3:
                $status = 'ACCEPTED';
                break;
            case 4:
                $status = 'REJECTED';
                break;
            case 5:
                $status = 'PENDING';
                break;
            default:
                $status = 'UNKNOWN';
        }
        return $status;
    }

    public function getStatusTextColorAttribute($value){
        $status = 'secondary';
        switch(optional($this->usulan)->status_usulan){
            case 0 :
                $status = "secondary";
                break;
            case 1 :
                $status = 'success';
                break;
            case 5:
            case 2:
                $status = 'warning';
                break;
            case 3:
                $status = 'primary';
                break;
            case 4:
                $status = 'danger';
                break;
            default:
                $status = 'secondary';
        }
        return $status;
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

    public function getRingkasanEksekutifSimpleAttribute($value){
        $ringkasan = str_replace(
            '</p>',
            '',
            str_replace('<p>', '', $this->ringkasan_eksekutif));
        return $ringkasan;
    }

}
