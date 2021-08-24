<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 
use App\User;
use Validator;
use App\Project;
use DB;
use Carbon\Carbon;


class LighterController extends Controller {


    public $successStatus = 200;

    public function getLighter(Request $request){
        $records = DB::table('lighter_detail')->where('project_id',$request->project_id)->get();
        if($records){
             return response()->json(['success' => 1,'records'=> $records]); 
        }else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]);
        }
    }

   

}


    
