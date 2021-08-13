<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';

    protected $fillable = [
        'name', 'route'
    ];
    public function routes() {
        return $this->hasMany('App\Route');
    }

    public function route() {
        return explode(',', $this->route);
    }

}
