<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchingTv extends Model
{
    protected $table = 'watchingtv';
    
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
