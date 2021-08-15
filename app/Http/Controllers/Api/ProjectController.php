<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Repositories\UserRepository;
use Illuminate\Support\Facades\Auth; 
use App\User;
use Validator;
use App\Friend;
use App\Project;
use DB;
use Carbon\Carbon;


class ProjectController extends Controller {


    public $successStatus = 200;

    public function index() {
        $records = DB::table('project')->get();
        return response()->json(['success' => 1,'records'=>$records], $this->successStatus); 
    }



    public function store(Request $request) {
         $input = $request->all();
         $validator = Validator::make($request->all(), [ 
            'code' => 'required|unique:project',
            'customer_buy' => 'required',
            'customer_sell' => 'required', 
            'contact_date' => 'required', 
            'contract-term' => 'required',
            'address_id' => 'required',
            'ship_name' => 'required',
        ]);
        if ($validator->fails()) { 
                    return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        $input['created_by'] = \Auth::user()->id;
        $project = DB::table('project')->insert($input);
        if ($project) {
             return response()->json(['success' => 1]); 
        }else {
            return response()->json(['success' => 0]); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $record = DB::table('project')->where('id',$id)->first();
        if($record){
           return response()->json(['success' => 1,'record'=>$record]); 
        }else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]); 
        }
    }


    public function update(Request $request, $id) {
        $input = $request->all();
         $validator = Validator::make($request->all(), [ 
            'code' => 'required|unique:project,code,' . $id . ',id',
            'customer_buy' => 'required',
            'customer_sell' => 'required', 
            'contact_date' => 'required', 
            'contract-term' => 'required',
            'address_id' => 'required',
            'ship_name' => 'required',
        ]);
        if ($validator->fails()) { 
                    return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        $project = DB::table('project')->where('id',$id)->update($input);
        if ($project) {
             return response()->json(['success' => 1]); 
        }else {
            return response()->json(['success' => 0]); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        DB::table('project')->where('id',$id)->delete();
        return response()->json(['success' => 1]);
    }

}


    
