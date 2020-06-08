<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActorMovie extends Model
{
    protected $table = 'actormovie';
    
    protected $fillable = [
        'idactor', 'idmovie', 'character',
    ];
    
    public function actor(){
        return $this->belongsTo('App\Actor','idactor');
    }
    
    public function movie(){
        return $this->belongsTo('App\Movie','idmovie');
    }
    
    public $timestamps = false;
}
