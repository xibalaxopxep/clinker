<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TemplateSettingRepository;
use App\Repositories\TemplateAttributeRepository;

class TemplateSettingController extends Controller {
    public function __construct(TemplateSettingRepository $templateRepo,TemplateAttributeRepository $attribute) {
        $this->templateRepo = $templateRepo;
        $this->attribute=$attribute;
    }

    public function index() {
        $records = $this->templateRepo->getAll();
        $attributes=$this->attribute->getAll()->toArray();
        $attribute = array();
        foreach($attributes as $key=>$val){
            $attribute[$val['title']]=$val;
        }
        return view('backend/template_setting/index', compact('records','attribute'));
    }
    public function create() {
        $attribute_html = \App\Helpers\StringHelper::getSelectOptions($this->attribute->getAll());
        return view('backend/template_setting/create',compact('attribute_html'));
    }

    public function store(Request $request) {
        $input = $request->all();
        $this->templateRepo->create($input);
        return redirect()->route('admin.template_setting.index')->with('success', 'Tạo mới thành công');
    }

}
