<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListTv extends Model
{
    protected $table = 'listtv';
    
    protected $fillable = [
        'idlist', 'idtv',
    ];
    
    public function userlist(){
        return $this->belongsTo('App\Userlist','idlist');
    }
    
    public function tv(){
        return $this->belongsTo('App\Tv','idtv');
    }
    
}
