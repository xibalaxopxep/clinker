<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';
    protected $fillable = ['name','member_id','mobile','company_name','email','content','is_read'];
    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }

}
