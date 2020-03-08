<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsulanKomentar extends Model
{

    const OPEN = 0;
    const CLOSED = 1;

    const STATUSES = [
        self::OPEN => 'Open',
        self::CLOSED => 'Closed'
    ];

    protected $table='usulan_komentars';

    protected $guarded = [];

    public function usulan(){
        return $this->belongsTo(Usulan::class, 'usulan_id', 'id');
    }

    public function getStatusTextAttribute($value){
        return self::STATUSES[$this->status];
    }

    public function getStatusIconAttribute($value){
        if($this->status == self::OPEN){
            return '<i class="cil-ban text-danger"></i>';
        }else{
            return '<i class="cil-check-circle text-success"></i>';
        }
    }
}
