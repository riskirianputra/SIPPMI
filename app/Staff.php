<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use SoftDeletes;

    public $table = 'staff';

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

    protected $fillable = [
        'id',
        'nip',
        'nama',
        'email',
        'status',
        'telepon',
        'created_at',
        'updated_at',
        'deleted_at',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
    ];

    public function getTanggalLahirAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTanggalLahirAttribute($value)
    {
        $this->attributes['tanggal_lahir'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
