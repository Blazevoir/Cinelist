<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $table = 'season';
    
    protected $fillable = [
        'idtv', 'release_date', 'title', 'number', 'total_episodes', 
        'description', 'poster',
    ];
    
    public function tv(){
        return $this->belongsTo('App\Tv','idtv');
    }
    public function watchedEpisoed(){
        return $this->hasMany('App\WatchedEpisode');
    }
    public function episode(){
        return $this->hasMany('App\Episode');
    }
    
    public $timestamps = false;     
}
