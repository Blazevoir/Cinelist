<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planned extends Model
{
    protected $table = 'planned';
    
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
