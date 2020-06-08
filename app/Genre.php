<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genre';
    
    protected $fillable = [
        'name',
    ];
    
    public function genremovie(){
        return $this->hasMany('App\GenreMovie');
    }
    
    public $timestamps = false;
}
