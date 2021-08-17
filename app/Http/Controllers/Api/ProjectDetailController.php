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

    public function index(Request $request) {
        $records = DB::table('project_detail')->where('project_id',$request->project_id)->get();
        return response()->json(['success' => 1,'records'=>$records], $this->successStatus); 
    }



    public function store(Request $request) {
         $input = $request->except('project_id');
         $validator = Validator::make( $input, [ 
            'title' => 'required',
            'address_id' => 'required',
            'lighter_codes' => 'required', 
            'deadline' => 'required', 
            
        ]);
        if ($validator->fails()) { 
             $errorString = implode("\r\n",$validator->messages()->all());
                    return response()->json(['error'=>$errorString]);                 
        }
        $input['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        $input['created_by'] = \Auth::user()->id;
        $input['project_id'] = $request->project_id;
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
    public function show(Request $request) {
        $record = DB::table('project_detail')->where('id',$request->id)->first();
        if($record){
           return response()->json(['success' => 1,'record'=>$record]); 
        }else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]); 
        }
    }


    public function update(Request $request) {
         $input = $request->except('id');
         $validator = Validator::make($input, [ 
            'title' => 'required',
            'address_id' => 'required',
            'lighter_codes' => 'required', 
             'deadline' => 'required', 
            
        ]);
        if ($validator->fails()) { 
                $errorString = implode("\r\n",$validator->messages()->all());
                return response()->json(['error'=>$errorString]);                 
        }
        $input['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        $project = DB::table('project_detail')->where('id',$request->id)->update($input);
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
    public function destroy(Request $request) {

        DB::table('project_detail')->where('id',$request->id)->delete();
        return response()->json(['success' => 1]);
    }

   

}


    
