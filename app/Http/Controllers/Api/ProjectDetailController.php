<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 
use App\User;
use Validator;
use App\Friend;
use App\Project;
use DB;
use Carbon\Carbon;


class ProjectDetailController extends Controller {


    public $successStatus = 200;

    public function index($project_id) {
        $records = DB::table('project_detail')->where('project_id',$project_id)->get();
        return response()->json(['success' => 1,'records'=>$records], $this->successStatus); 
    }



    public function store(Request $request,$project_id) {
         $input = $request->all();
         $validator = Validator::make($request->all(), [ 
            'title' => 'required',
            'address_id' => 'required',
            'lighter_codes' => 'required', 
            'deadline' => 'required', 
            
        ]);
        if ($validator->fails()) { 
                    return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        $input['created_by'] = \Auth::user()->id;
        $input['project_id'] = $project_id;
        $project = DB::table('project_detail')->insert($input);
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
        $record = DB::table('project_detail')->where('id',$id)->first();
        if($record){
           return response()->json(['success' => 1,'record'=>$record]); 
        }else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]); 
        }
    }


    public function update(Request $request, $id) {
         $input = $request->all();
         $validator = Validator::make($request->all(), [ 
            'title' => 'required',
            'address_id' => 'required',
            'lighter_codes' => 'required', 
             'deadline' => 'required', 
            
        ]);
        if ($validator->fails()) { 
                    return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        $project = DB::table('project_detail')->where('id',$id)->update($input);
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

        DB::table('project_detail')->where('id',$id)->delete();
        return response()->json(['success' => 1]);
    }

   

}


    
