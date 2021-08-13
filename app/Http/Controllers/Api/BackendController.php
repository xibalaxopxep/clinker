<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\StringHelper;
use App\Repositories\OrderRepository;
use DB;
use Carbon\Carbon;


class BackendController extends Controller {

    public function __construct(OrderRepository $orderRepo) {
        $this->orderRepo = $orderRepo;
    }

    public function slugify(Request $request) {
        return response()->json(['alias' => StringHelper::slug($request->get('title'))]);
    }

    public function changeStatus(Request $request) {
       $coupon_code=$request->coupon_code;
            $query=DB::table('coupon')->where('coupon_code',$coupon_code)->first();

            
            if ($query){
                if($query->coupon_number>0 && $query->coupon_end>Carbon::now('Asia/Ho_Chi_Minh')){
          
                return response()->json(array('statusCode' => 200,"statusCode"=>200,"value"=>$query->coupon_value,'condition'=>$query->coupon_condition,'type_coupon'=>$query->coupon_type));
                }
                else{
                    return response()->json(array("statusCode"=>201));
                }
            }
            else{
                  return response()->json(array("statusCode"=>201));
               
            }
    }

    public function select_address(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = DB::table('district')->where('city_id',$data['ma_id'])->orderby('id_qh','ASC')->get();
                    $output.='<option>---Chọn quận huyện---</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->id_qh.'">'.$province->name_qh.'</option>';
                }

            }else{

                $select_wards = DB::table('wards')->where('district_id',$data['ma_id'])->orderby('id_xp','ASC')->get();
                $output.='<option>---Chọn xã phường---</option>';
                foreach($select_wards as $key => $ward){
                    $output.='<option value="'.$ward->id_xp.'">'.$ward->name_xp.'</option>';
                }
            }
            echo $output;
        }
        
    }


    public function apply_coupon(Request $request)
    {

            
        $discounted_price=  100;

        $result->val = $discounted_price;
       
        return json_encode($result);

    }

}
