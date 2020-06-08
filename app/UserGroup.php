<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $table = 'usergroup';
    
    protected $fillable = [
        'idgroup', 'iduser',
    ];
    
    public function userlist(){
        return $this->belongsTo('App\Group','idgroup');
    }
    
    public function movie(){
        return $this->belongsTo('App\User','iduser');
    }
}
