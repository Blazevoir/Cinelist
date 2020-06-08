<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorite';
    
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
