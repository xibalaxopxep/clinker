<?php

namespace App\Repositories;


use Repositories\Support\AbstractRepository;

class TemplateSettingRepository extends AbstractRepository
{
    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\TemplateSetting';
    }
    public function getAll(){
        $records = $this->model->join('template_attribute','template_setting.attribute_id','template_attribute.id')->select('template_setting.name', 'template_setting.value', 'template_attribute.title')->get();
        $result = array();
        foreach($records as $key=>$val){
            $result[$val->name][$val->title] = $val->value;
           
        }
        return $result;
    }
    public function updateBy($name,$attribute_id,$value){
        return $this->model->where('name',$name)->where('attribute_id',$attribute_id)->update($value);
    }
    
}