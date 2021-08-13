<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Construction extends Authenticatable {

    protected $table = "construction";
    protected $fillable = [
        'full_name', 'alias', 'status','state', 'vip', 'email', 'mobile', 'address', 'description', 'avatar', 'cover', 'password', 'website', 'activation', 'country_id', 'activation', 'username'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function items() {
        return $this->belongsToMany('\App\Item', 'construction_item', 'construction_id', 'item_id');
    }

    public function url() {
        return route('construction.detail', ['alias' => $this->alias]);
    }

    public function reviews() {
        return $this->hasMany('\App\Review');
    }

    public function projects() {
        return $this->hasMany('\App\Project');
    }

    public function star() {
        $count = ($this->reviews->count());
        $quantity = $this->reviews()->sum('star');
        if ($count > 0) {
            return ($quantity / $count);
        }
        return 0;
    }

}
