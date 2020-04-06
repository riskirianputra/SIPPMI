<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewPenilaian extends Model
{
    protected $table = 'review_penilaians';

    protected $guarded = [];

    public function review()
    {
        return $this->belongsTo(Review::class, 'review_id', 'id');
    }

    public function getSubTotalAttribute($value)
    {
        return $this->bobot * $this->nilai;
    }
}
