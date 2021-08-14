<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Statistic;

use DB;
use App\Product;
use App\Supplier;
use App\Member;
use App\Coupon;
use App\Import;
use App\Contact;
use App\News;



class BackendController  extends Controller
{
    

       public function index() {
        //$coupons = $this->couponRepo->all();
          

        return view('backend/index');
    }


   


}