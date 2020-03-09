<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TahapanReview extends Model
{
    use SoftDeletes;

    public $table = 'tahapan_reviews';

    protected $dates = [
        'mulai',
        'selesai',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const JUMLAH_REVIEWER = [
        1 => 1,
        2 => 2,
        3 => 3
    ];

    protected $fillable = [
        'nama',
        'mulai',
        'selesai',
        'tahun',
        'created_at',
        'updated_at',
        'deleted_at',
        'jumlah_reviewer',
    ];

    public function tahapanReviewPenelitianReviewers()
    {
        return $this->hasMany(PenelitianReviewer::class, 'tahapan_review_id', 'id');
    }

    public function getMulaiAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setMulaiAttribute($value)
    {
        $this->attributes['mulai'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getSelesaiAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setSelesaiAttribute($value)
    {
        $this->attributes['selesai'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
