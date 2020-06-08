<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tv extends Model
{
    protected $table = 'tv';
    
    protected $fillable = [
        'title', 'original_title', 'original_language', 'release_date',
        'description', 'thumbnail', 'poster', 'web', 'status', 'trailer', 'in_production', 'next_episode', 'total_episodes', 
        'total_seasons',
    ];
    
    public function genretv(){
        return $this->hasMany('App\GenreTv');
    }
    
    public function companytv(){
        return $this->hasMany('App\CompanyTv');
    }
    
    public function imagetv(){
        return $this->hasMany('App\ImageTv');
    }    
    
    public function actortv(){
        return $this->hasMany('App\ActorTv');
    }
    
    public function season(){
        return $this->hasMany('App\Season');
    }
    
    public function episode(){
        return $this->hasMany('App\Episode');
    }    
    
    public function scoretv(){
        return $this->hasMany('App\ScoreTv');
    }   
    
    public function favoritetv(){
        return $this->hasMany('App\FavoriteTv');
    }   
    
    public function plannedtv(){
        return $this->hasMany('App\PlannedTv');
    }      
    
    public function reviewtv(){
        return $this->hasMany('App\ReviewTv');
    }
    
    public function listmedia(){
        return $this->hasMany('App\ListMedia');
    }  
    
    public function watchedtv(){
        return $this->hasMany('App\WatchedTv');
    }          
    
    public function watchedepisode(){
        return $this->hasMany('App\WatchedEpisode');
    }      
    
    public function watchiongtv(){
        return $this->hasMany('App\WatchingTv');
    }   
    public function checkreviewtv(){
        return $this->hasMany('App\UserLikedTv');
    }   
        
        public $timestamps = false;
}
