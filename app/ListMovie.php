<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListMovie extends Model
{
    protected $table = 'listmovie';
    
    protected $fillable = [
        'idlist', 'idmovie',
    ];
    
    public function userlist(){
        return $this->belongsTo('App\Userlist','idlist');
    }
    
    public function movie(){
        return $this->belongsTo('App\Movie','idmovie');
    }
    
}
