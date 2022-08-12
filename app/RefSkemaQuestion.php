<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefSkemaQuestion extends Model
{
    protected $guarded = [];

    public function skema()
    {
        return $this->belongsTo(RefSkema::class);
    }

    public function getPertanyaanSimpleAttribute()
    {
        $judul = str_replace('<p>', '', $this->pertanyaan);
        $judul = str_replace('</p>', '', $judul);
        return $judul;
    }
}
