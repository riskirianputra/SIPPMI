<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenelitianOutput extends Model
{
    use SoftDeletes;

    public $table = 'penelitian_outputs';

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
        'penelitian_id',
        'tanggal_upload',
        'output_skema_id',
    ];

    public function output_skema()
    {
        return $this->belongsTo(OutputSkema::class, 'output_skema_id');
    }

    public function penelitian()
    {
        return $this->belongsTo(Penelitian::class, 'penelitian_id');
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
