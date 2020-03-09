<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengabdianOutput extends Model
{
    use SoftDeletes;

    public $table = 'pengabdian_outputs';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'tanggal_upload',
    ];

    protected $fillable = [
        'filename',
        'created_at',
        'updated_at',
        'deleted_at',
        'pengabdian_id',
        'tanggal_upload',
        'output_skema_id',
    ];

    public function output_skema()
    {
        return $this->belongsTo(OutputSkema::class, 'output_skema_id');
    }

    public function pengabdian()
    {
        return $this->belongsTo(Pengabdian::class, 'pengabdian_id');
    }

    public function getTanggalUploadAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTanggalUploadAttribute($value)
    {
        $this->attributes['tanggal_upload'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
