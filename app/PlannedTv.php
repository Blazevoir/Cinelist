<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlannedTv extends Model
{
    protected $table = 'plannedtv';
    
     protected $fillable = [
        'iduser', 'idtv',
    ];
    
    public $timestamps = false;
    
    public function user(){
        return $this->belongsTo('App\User','iduser');
    }
    
    public function tv(){
        return $this->belongsTo('App\Tv','idtv');
    }
}
