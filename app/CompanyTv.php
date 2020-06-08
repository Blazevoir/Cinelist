<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyTv extends Model
{
    protected $table = 'companytv';
    
    protected $fillable = [
        'idcompany', 'idtv',
    ];
    
    public function genre(){
        return $this->belongsTo('App\Company','idcompany');
    }
    
    public function movie(){
        return $this->belongsTo('App\Tv','idtv');
    }
    
    public $timestamps = false;    
}
