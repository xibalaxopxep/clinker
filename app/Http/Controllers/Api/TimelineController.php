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


class TimelineController extends Controller {


    public $successStatus = 200;

    public function index(Request $request) {
        $records = DB::table('project_detail')->where('project_id',$request->project_id)->orderBy('deadline','asc')->get();
        return response()->json(['success' => 1,'records'=>$records], $this->successStatus); 
    }



    public function store(Request $request) {
         $input = $request->except('project_id');
         $validator = Validator::make( $input, [ 
            'work_id' => 'required',
            'lighter_id' => 'required', 
            'group_name' => 'required', 
            'deadline'=> "required",
        ]);
        if ($validator->fails()) { 
             $errorString = implode("\r\n",$validator->messages()->all());
                    return response()->json(['error'=>$errorString]);                 
        }
        $input['status'] = 1;
        $input['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        $input['created_by'] = \Auth::user()->id;
        $input['project_id'] = $request->project_id;
        $input['lighter_code'] = DB::table('lighter_detail')->where('id',$request->lighter_id)->value('lighter_code');
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
            return response()->json(['error' => "Kh??ng t??m th???y d??? li???u"]); 
        }
    }


    public function update(Request $request) {
         $input = $request->except('project_id');
        //  $validator = Validator::make( $input, [ 
        //     'work_id' => 'required',
        //     'address' => 'required',
        //     'lighter_id' => 'required', 
        //     'group_name' => 'required', 
        //     'deadline'=> "required",
        // ]);
        // if ($validator->fails()) { 
        //      $errorString = implode("\r\n",$validator->messages()->all());
        //             return response()->json(['error'=>$errorString]);                 
        // }
        $input['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        $input['created_by'] = \Auth::user()->id;
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


    
