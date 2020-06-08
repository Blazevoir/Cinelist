<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchedEpisode extends Model
{
    protected $table = 'watchedepisode';
    
    protected $fillable = [
        'iduser', 'idepisode', 'idtv', 'idseason',
    ];
    
    public function user(){
        return $this->belongsTo('App\User','iduser');
    }
    
    public function episode(){
        return $this->belongsTo('App\Episode','idepisode');
    }
    
    public function season(){
        return $this->belongsTo('App\Season','idseason');
    }
    
    public function tv(){
        return $this->belongsTo('App\Tv','idtv');
    }
     
}
