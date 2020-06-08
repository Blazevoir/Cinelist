<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userlist extends Model
{
    protected $table = 'userlist';
    
    protected $fillable = [
        'name', 'iduser',
    ];
    
    public function user(){
        return $this->belongsTo('App\User','iduser');
    }
    
    public function listmovie(){
        return $this->hasMany('App\ListMovie');
    } 
    
    public function listtv(){
        return $this->hasMany('App\ListTv');
    }     
}
