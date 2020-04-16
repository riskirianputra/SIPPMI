<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    public $table = 'reviews';

    protected $guarded = [];

    protected $dates = [
        'review_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function tahapan_review()
    {
        return $this->belongsTo(TahapanReview::class, 'tahapan_review_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(Reviewer::class, 'reviewer_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'reviewer_id', 'id');
    }

    public function usulan()
    {
        return $this->belongsTo(Usulan::class, 'usulan_id','id');
    }

    public function ayam()
    {
        return $this->belongsTo(Usulan::class, 'usulan_id','id');
    }

    public function penilaians()
    {
        return $this->hasMany(ReviewPenilaian::class, 'review_id', 'id');
    }

    /** Extended Attribute */
    public function getSubTotalAttribute()
    {
        $penilaians = $this->penilaians;
        $total = 0;
        foreach($penilaians as $penilaian)
        {
            $total += $penilaian->sub_total;
        }
        return $total;
    }
}
