<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyMovie extends Model
{
    protected $table = 'companymovie';
    
    protected $fillable = [
        'idcompany', 'idmovie',
    ];
    
    public function genre(){
        return $this->belongsTo('App\Company','idcompany');
    }
    
    public function movie(){
        return $this->belongsTo('App\Movie','idmovie');
    }
    
    public $timestamps = false;
}
