<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Output extends Model
{
    use SoftDeletes;

    public $table = 'outputs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'code',
        'luaran',
        'created_at',
        'updated_at',
        'deleted_at',
        'jenis_usulan',
    ];

    public function outputOutputSkemas()
    {
        return $this->hasMany(OutputSkema::class, 'output_id', 'id');
    }

    public function jenis_usulan()
    {
        return $this->belongsTo(JenisUsulan::class, 'jenis_usulan_id');
    }
}
