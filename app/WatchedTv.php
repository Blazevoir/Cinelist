<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchedTv extends Model
{
    protected $table = 'watchedtv';
    
    protected $fillable = [
        'iduser', 'idtv',
    ];
    
    public function user(){
        return $this->belongsTo('App\User','iduser');
    }
    
    public function tv(){
        return $this->belongsTo('App\Tv','idtv');
    }
     
}
