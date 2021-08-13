<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\MarketingRepository;

class MarketingController extends Controller {
    public function __construct(MarketingRepository $marketingRepo) {
        $this->marketingRepo = $marketingRepo;
    }

    public function activation($key){
        $check=$this->marketingRepo->checkactivation($key);
        $input['status']=1;
        if($check){
            $this->marketingRepo->update($input,$check->id);
        }
        return view('frontend/notification/index');
    }
    public function index(Request $request){
        $search = $request->all();
        $records=$this->marketingRepo->getData($request,\Auth::guard('marketing')->user()->id);
        $total=0;
        foreach($records as $key=>$val){
            $records[$key]->comistion = $val->total * ($val->discount_percent/100);
            $total +=$records[$key]->comistion;
        }
        return view('frontend/marketing/index',compact('records','total','search'));
    }
}
