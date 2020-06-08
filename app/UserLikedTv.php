<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLikedTv extends Model
{
    protected $table = 'userlikedtv';
    
    protected $fillable = [
        'iduser', 'idreviewtv', 'tipo',
    ];
    
    public function user(){
        return $this->belongsTo('App\User','iduser');
    }
    
    public function reviewTv(){
        return $this->belongsTo('App\ReviewTv','idreviewtv');
    }
     
     public function tv(){
        return $this->belongsTo('App\Tv','idtv');
    }     
}
