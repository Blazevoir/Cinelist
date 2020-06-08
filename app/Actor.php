<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $table = 'actor';
    
    protected $fillable = [
        'name','gender','biography','profile_pic','birth_date','death_date',
    ];
    
    public function actormovie(){
        return $this->hasMany('App\ActorMovie');
    }
    
    public $timestamps = false;
}
