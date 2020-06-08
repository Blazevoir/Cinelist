<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchedMovie extends Model
{
    protected $table = 'watchedmovie';
    
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
