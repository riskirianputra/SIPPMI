<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Usulan extends Model
{
    use SoftDeletes;

    public $table = 'usulans';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const PENELITIAN = 'P';
    const PENGABDIAN = 'PkM';

    const JENIS_USULAN = [
        self::PENELITIAN => 'Penelitian',
        self::PENGABDIAN => 'Pengabdian kepada Masyarakat',
    ];

    protected $fillable = [
        'created_at',
        'updated_at',
        'deleted_at',
        'pengusul_id',
        'jenis_usulan',
        'status_usulan',
    ];

    const STATUS_USULAN_SELECT = [
        '0' => 'Draft',
        '1' => 'Submitted',
        '2' => 'Reviewing',
        '3' => 'Accepted',
        '4' => 'Rejected',
        '5' => 'Pending',
    ];

    public function pengusul()
    {
        return $this->belongsTo(User::class, 'pengusul_id');
    }

    public function anggotas(){
        return $this->hasMany(UsulanAnggotum::class,'usulan_id','id');
    }

    public function penelitian(){
        return $this->hasOne(Penelitian::class,'id','id');
    }

    public function pengabdian(){
        return $this->hasOne(Pengabdian::class,'id','id');
    }

    public function komentars()
    {
        return $this->hasMany(UsulanKomentar::class, 'usulan_id', 'id');
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
}
