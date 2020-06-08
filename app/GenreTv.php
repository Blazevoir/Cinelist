<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenreTv extends Model
{
    protected $table = 'genretv';
    
    protected $fillable = [
        'idgenre', 'idtv',
    ];
    
    public function genre(){
        return $this->belongsTo('App\Genre','idgenre');
    }
    
    public function movie(){
        return $this->belongsTo('App\Tv','idtv');
    }
    
    public $timestamps = false;    
}
