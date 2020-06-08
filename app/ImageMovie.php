<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageMovie extends Model
{
    protected $table = 'imagemovie';
    
    protected $fillable = [
        'idmovie', 'url', 'height', 'width',
    ];
    
    public function movie(){
        return $this->belongsTo('App\Movie','idmovie');
    }
    public $timestamps = false;
}
