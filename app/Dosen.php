<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dosen extends Model
{
    use SoftDeletes;

    public $table = 'dosens';

    const JENIS_KELAMIN_RADIO = [
        'Laki-laki' => 'L',
        'Perempuan' => 'P',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'tanggal_lahir',
    ];

    const PANGKAT_GOLONGAN_SELECT = [
        '11' => 'I/a - Juru Muda',
        '12' => 'I/b - Juru Muda Tk I',
        '13' => 'I/c - Juru',
        '14' => 'I/d - Juru Tk I',
        '21' => 'II/a - Pengatur Muda',
        '22' => 'II/b - Pengatur Muda Tk I',
        '23' => 'II/c - Pengatur',
        '24' => 'II/d - Pengatur Tk I',
        '31' => 'III/a - Penata Muda',
        '32' => 'III/b - Penata Muda Tk I',
        '33' => 'III/c - Penata',
        '34' => 'III/d - Penata Tk I',
        '41' => 'III/a - Pembina',
        '42' => 'III/b - Pembina Tk I',
        '43' => 'III/c - Pembina Utama Muda',
        '44' => 'III/d - Pembina Utama Madya',
        '45' => 'III/e - Pembina Utama'
    ];

    const JABATAN_FUNGSIONAL_SELECT = [
        'DSN' => 'Staf Pengajar (Dosen)',
        'AA'  => 'Asisten Ahli',
        'L'   => 'Lektor',
        'LK'  => 'Lektor Kepala',
        'GB'  => 'Guru Besar',
    ];

    protected $fillable = [
        'id',
        'nip',
        'nama',
        'nidn',
        'email',
        'status',
        'telepon',
        'prodi_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'pangkat_golongan',
        'jabatan_fungsional',
    ];

    public function dosenPenelitianAnggota()
    {
        return $this->hasMany(PenelitianAnggotum::class, 'dosen_id', 'id');
    }

    public function user(){
        return $this->hasOne(User::class,'id','id');
    }

    public function dosenPengabdianAnggota()
    {
        return $this->hasMany(PengabdianAnggotum::class, 'dosen_id', 'id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function skemas()
    {
        return $this->belongsToMany(RefSkema::class, DosenSkema::class, 'dosen_id', 'ref_skema_id');
    }

    public function getTanggalLahirAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTanggalLahirAttribute($value)
    {
        $this->attributes['tanggal_lahir'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getNamaNidnAttribute($value){
        return $this->nama.' - '.$this->nidn;
    }
}
