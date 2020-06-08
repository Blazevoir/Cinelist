<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'description', 'source', 'token',  'twitter', 'google', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    //Movie relationships
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
    
    public function listmovie(){
        return $this->hasMany('App\ListMovie');
    }    
    
    //Tv relationships
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
    
    public function listtv(){
        return $this->hasMany('App\ListTv');
    }    
    
    //user user relationship
    public function group(){
        return $this->hasMany('App\Group');
    }        
    
    public function friend(){
        return $this->hasMany('App\Friend');
    }       

}
