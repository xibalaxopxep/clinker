<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model {

    //
    protected $table = "rank";
    protected $fillable = [
        'title', 'ordering', 'discount_percent','condition',
    ];
}
