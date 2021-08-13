<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TemplateSettingRepository;

class TemplateSettingController extends Controller {

    public function __construct(TemplateSettingRepository $templateRepo) {
        $this->templateRepo = $templateRepo;
    }
    public function update(Request $request) {
        $input = $request->all();
        foreach($input as $key=>$val){
             if($key != 'name' && $key != '_token'){
                $template['value']=$val;
                $this->templateRepo->updateBy($input['name'],$key,$template);
             }
        }
        return response()->json(array('success' => true,'message'=>'Lưu thành công'));
    }
}
