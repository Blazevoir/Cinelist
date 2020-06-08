<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';
    
    protected $fillable = [
        'iduser', 'idmovie', 'content', 'upvotes', 'downvotes', 'reports',
    ];
    
    public function user(){
        return $this->belongsTo('App\User','iduser');
    }
    
    public function movie(){
        return $this->belongsTo('App\Movie','idmovie');
    }
    
    public function liked(){
        return $this->hasMany('App\UserLikedMovie');
    }     
}
