<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageTv extends Model
{
    protected $table = 'imagetv';
    
    protected $fillable = [
        'idtv', 'url', 'height', 'width',
    ];
    
    public function tv(){
        return $this->belongsTo('App\Tv','idtv');
    }
    
    public $timestamps = false;    
}
