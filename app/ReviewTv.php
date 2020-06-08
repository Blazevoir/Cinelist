<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewTv extends Model
{
    protected $table = 'reviewtv';
    
    protected $fillable = [
        'iduser', 'idtv', 'content', 'upvotes', 'downvotes', 'reports',
    ];
    
    public function user(){
        return $this->belongsTo('App\User','iduser');
    }
    
    public function tv(){
        return $this->belongsTo('App\Tv','idtv');
    }
    
    public function liked(){
        return $this->hasMany('App\UserLikedTv');
    } 
}
