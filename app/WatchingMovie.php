<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchingMovie extends Model
{
    protected $table = 'watchingmovie';
    
    protected $fillable = [
        'iduser', 'idmovie',
    ];
    
    public function user(){
        return $this->belongsTo('App\User','iduser');
    }
    
    public function movie(){
        return $this->belongsTo('App\Movie','idmovie');
    }
     
}
