<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenelitianReviewer extends Model
{
    use SoftDeletes;

    public $table = 'penelitian_reviewers';

    protected $fillable = [
        'reviewer_id',
        'usulan_id',
        'tahapan_review_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
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

    public function usulan()
    {
        return $this->belongsTo(Usulan::class, 'usulan_id','id');
    }

    public function ayam()
    {
        return $this->belongsTo(Usulan::class, 'usulan_id','id');
    }
}
