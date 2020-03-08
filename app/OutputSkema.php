<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutputSkema extends Model
{
    use SoftDeletes;

    public $table = 'output_skemas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'mime',
        'field',
        'skema_id',
        'required',
        'output_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function outputSkemaPenelitianOutputs()
    {
        return $this->hasMany(PenelitianOutput::class, 'output_skema_id', 'id');
    }

    public function outputSkemaPengabdianOutputs()
    {
        return $this->hasMany(PengabdianOutput::class, 'output_skema_id', 'id');
    }

    public function output()
    {
        return $this->belongsTo(Output::class, 'output_id');
    }

    public function skema()
    {
        return $this->belongsTo(RefSkema::class, 'skema_id');
    }
}
