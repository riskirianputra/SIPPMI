<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DosenSkema extends Model
{
    protected $table = 'dosen_skemas';

    public function skema()
    {
        return $this->belongsTo(RefSkema::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
