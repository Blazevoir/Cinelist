<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    
    protected $fillable = [
        'name','logo',
    ];
    
    public function companymovie(){
        return $this->hasMany('App\CompanyMovie');
    }
    
    public $timestamps = false;
}
