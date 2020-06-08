<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'group';
    
    protected $fillable = [
        'name', 'iduser',
    ];
    
    public function group(){
        return $this->hasMany('App\UserGroup');
    }   
}
