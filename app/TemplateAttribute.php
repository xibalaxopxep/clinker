<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateAttribute extends Model
{
    protected $table = 'template_attribute';
    protected $fillable = ['title','type'];
}
