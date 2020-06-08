<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenreMovie extends Model
{
    protected $table = 'genremovie';
    
    protected $fillable = [
        'idgenre', 'idmovie',
    ];
    
    public function genre(){
        return $this->belongsTo('App\Genre','idgenre');
    }
    
    public function movie(){
        return $this->belongsTo('App\Movie','idmovie');
    }
    
    public $timestamps = false;
}
