<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    const ROLE_ADMINISTRATOR = 1;
    const ROLE_ADMIN = [1,2,3,4];
    const ROLE_EDITOR = 2;
    const ROLE_AUTHOR = 3;
    const ROLE_CONTRIBUTOR = 4;
    
    protected $fillable = [
        'username', 'full_name', 'email','mobile','address', 'password', 'role_id', 'status', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function role() {
        return $this->belongsTo('App\Role');
    }
    
    public function created_at() {
        return date( "d/m/Y", strtotime($this->created_at));
    }
    public function updated_at() {
        return date( "d/m/Y", strtotime($this->updated_at));
    }
}
