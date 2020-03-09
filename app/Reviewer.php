<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Reviewer extends Model
{
    use SoftDeletes;

    public $table = 'reviewers';

    protected $appends = [
        'sertifikat',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const STATUS_SELECT = [
        '1' => 'Aktif',
        '2' => 'Tidak Aktif',
    ];

    protected $fillable = [
        'id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

//    public function registerMediaConversions(Media $media = null)
//    {
//        $this->addMediaConversion('thumb')->width(50)->height(50);
//    }

    public function dosen(){
        return $this->hasOne(Dosen::class,'id','id');
    }

    public function penelitianReviewers()
    {
        return $this->hasMany(PenelitianReviewer::class, 'reviewer_id', 'id');
    }

//    public function getSertifikatAttribute()
//    {
//        return $this->getMedia('sertifikat')->last();
//    }
}
