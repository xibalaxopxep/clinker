<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model {

    
    const WAIT = 0;
    const YES = 1;
    const NO = -1;
    
    protected $table = "friend";
    protected $fillable = [
        'user_id', 'friend_id', 'type'
    ];
    public $timestamps = false;

}
