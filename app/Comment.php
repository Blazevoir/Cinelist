<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    
    protected $fillable = [
        'idprofile','iduser','content',
    ];
    
    public function user(){
        return $this->belongsTo('App\User','iduser');
    }
    
    public function profile(){
        return $this->belongsTo('App\User','idprofile');
    }
}
