<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spam extends Model
{
    protected $table = 'spam';
    
    protected $fillable = [
        'email'
    ];
    
    public $timestamps = false;     
}
