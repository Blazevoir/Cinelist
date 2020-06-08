<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreMovie extends Model
{
    protected $table = 'scoremovie';
    
    protected $fillable = [
       'iduser', 'idmovie', 'score', 
    ];
    
    public function user(){
        return $this->belongsTo('App\User','iduser');
    }
    
    public function movie(){
        return $this->belongsTo('App\Movie','idmovie');
    }
}
