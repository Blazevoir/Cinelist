<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLikedMovie extends Model
{
    protected $table = 'userlikedmovie';
    
    protected $fillable = [
        'iduser', 'idreviewmovie', 'tipo','idmovie',
    ];
    
    public function user(){
        return $this->belongsTo('App\User','iduser');
    }
    
    public function reviewMovie(){
        return $this->belongsTo('App\Review','idreviewmovie');
    }
     public function Movie(){
        return $this->belongsTo('App\Review','idmovie');
    }
     
}