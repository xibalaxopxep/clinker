<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\MemberRepository;

class MemberController extends Controller
{
    public function __construct(MemberRepository $memberRepo) {
        $this->memberRepo = $memberRepo;
    }

    public function activation($key){
        $check = $this->memberRepo->checkactivation($key);
        $input['status']=1;
        if($check){
            $this->memberRepo->update($input,$check->id);
        }
        return view('frontend/notification/index');
    }
    public function editProfile($alias) {
        session_start();
        $_SESSION['KCFINDER'] = []; //
        $_SESSION['KCFINDER'] = array('disabled' => false, 'uploadURL' => "/public/upload/m" . \Auth::guard('construction')->user()->id);
        $record = $this->memberRepo->findByAlias($alias);
        $item_arr = $this->itemRepo->readFE();
        $category_arr = $this->categoryRepo->readCategoryByType(\App\Category::TYPE_CONSTRUCTION);
        $category_html = \App\Helpers\StringHelper::getSelectOptions($item_arr, $record->items()->pluck('id')->toArray());
        if (config('global.device') != 'pc') {
            return view('mobile/construction/profile', compact('record', 'category_html','category_arr'));
        }
        else{
            return view('frontend/construction/profile', compact('record', 'category_html'));
        }
    }
}
