<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Group extends Authenticatable
{
    protected $table = 'group';
    protected $fillable = ['name'];
    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }
}
