<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $table = 'friend';
    
    protected $fillable = [
        'iduser1', 'iduser2', 'confirmed_at', 'declined_at', 'pending',
    ];
    
    public function userfriend(){
        return $this->belongsTo('App\User','iduser1');
    }
    
    public function userfriend2(){
        return $this->belongsTo('App\User','iduser2');
    }
}
