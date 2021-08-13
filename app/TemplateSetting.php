<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateSetting extends Model
{
    protected $table = 'template_setting';
    protected $fillable = ['name','attribute_id','value'];
    public $timestamps = false;
    public function attribute() {
        $data = $this->belongsTo('\App\TemplateAttribute', 'attribute_id', 'id');
        return $data;
    }
}
