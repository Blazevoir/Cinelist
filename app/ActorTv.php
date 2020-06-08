<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActorTv extends Model
{
    protected $table = 'actortv';
    
    protected $fillable = [
        'idactor', 'idtv', 'character',
    ];
    
    public function actor(){
        return $this->belongsTo('App\Actor','idactor');
    }
    
    public function tv(){
        return $this->belongsTo('App\Tv','idtv');
    }
    
        public $timestamps = false;
}
