<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreTv extends Model
{
    protected $table = 'scoretv';
    
    protected $fillable = [
       'iduser', 'idtv', 'score', 
    ];
    
    public function user(){
        return $this->belongsTo('App\User','iduser');
    }
    
    public function tv(){
        return $this->belongsTo('App\Tv','idtv');
    }
}
