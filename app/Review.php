<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {

    protected $table = "review";
    protected $fillable =[
        'star', 'construction_id', 'review_person_id', 'content'
    ];

    public function construction() {
        return $this->belongsTo('\App\Construction');
    }

    public function review_person() {
        return $this->belongsTo('\App\ReviewPerson', 'review_person_id', 'facebook_id');
    }

    public function created_at() {
        return date('d/m/Y', strtotime($this->created_at));
    }

}
