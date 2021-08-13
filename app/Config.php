<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model {

    protected $table = 'config';
    protected $fillable = [
        'title', 'company_name', 'address', 'hotline', 'phone', 'email', 'fanpage', 'image', 'favicon', 'twitter', 'youtube_channel', 'working_hours', 'description', 'keywords'
    ];
    public $timestamps = false;
}
