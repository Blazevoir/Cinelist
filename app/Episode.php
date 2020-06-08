<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $table = 'episode';
    
    protected $fillable = [
        'idseason', 'idtv', 'release_date', 'title', 'number', 
        'description', 'season_from', 'thumbnail',
    ];
    
    public function season(){
        return $this->belongsTo('App\Season','idseason');
    }
    
    public function tv(){
        return $this->belongsTo('App\Tv','idtv');
    }    
    
    public function watchedtv(){
        return $this->hasMany('App\WatchedEpisode');
    }          
    
    public $timestamps = false; 
}
