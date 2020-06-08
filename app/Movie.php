<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    protected $table = 'movie';
    
    protected $fillable = [
        'imdbid', 'title', 'original_title', 'original_language', 'release_date',
        'tagline', 'description', 'duration', 'thumbnail','poster',  'budget',
        'revenue', 'web', 'status', 'trailer',
    ];
    
    public function genremovie(){
        return $this->hasMany('App\GenreMovie');
    }
    
    public function companymovie(){
        return $this->hasMany('App\CompanyMovie');
    }
    
    public function imagemovie(){
        return $this->hasMany('App\ImageMovie');
    }    
    
    public function actormovie(){
        return $this->hasMany('App\ActorMovie');
    }
    
    public function scoremovie(){
        return $this->hasMany('App\ScoreMovie');
    }   
    
    public function favorite(){
        return $this->hasMany('App\Favorite');
    }   
    
    public function planned(){
        return $this->hasMany('App\Planned');
    }      
    
    public function review(){
        return $this->hasMany('App\Review');
    }
    
    public function listmedia(){
        return $this->hasMany('App\ListMedia');
    }    
    
    public function watchedmovie(){
        return $this->hasMany('App\WatchedMovie');
    }    
    
    public function watchigmovie(){
        return $this->hasMany('App\WatchingMovie');
    }           
    public function checkreviewtgeagaegv(){
        return $this->hasMany('App\UserLikedMovie');
    }       
    public $timestamps = false;
}
