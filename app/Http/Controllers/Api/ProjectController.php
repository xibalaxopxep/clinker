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
        $input = $request->except('project_member');
        $validator = Validator::make($input, [ 
            'code' => 'required|unique:project',
            'customer_buy' => 'required',
            'customer_sell' => 'required', 
            'contact_date' => 'required', 
            'contract-term' => 'required',

        ]);
        if ($validator->fails()) { 
                    $errorString = implode("\r\n",$validator->messages()->all());
                    return response()->json(['error'=>$errorString]);                 
        }
        $input['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        $input['created_by'] = \Auth::user()->id;
        if($request->ship_name == null){
            $input['status'] = 1;
        }else{
            $input['status'] = 2;
        }
        $project = DB::table('project')->insertGetId($input);
        if(count($request->project_member) >0){
        foreach($request->project_member as $member){
            $data['project_id'] = $project;
            $data['user_id'] = $member;
            $data['type_role'] = DB::table('user')->where('id', $member)->pluck('type')->first();
            DB::table('project_member')->insert($data);
        }
        }
        foreach( explode(',',$request->lighter_codes) as $lighter){
            $data1['project_id'] = $project;
            $data1['lighter_code'] = $lighter;
            DB::table('lighter_detail')->insert($data1);
        }

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
        $record = DB::table('project')->where('id',$request->id)->first();
        $project_member = DB::table('project_member')->join('user','user.id','=','project_member.user_id')->where('project_member.project_id',$request->id)->get();
        $host = $request->getSchemeAndHttpHost();
        foreach($project_member as $key => $member){
             $project_member[$key]->avatar = $host . $member->avatar;
        }
        if($record){
           return response()->json(['success' => 1,'record'=>$record,'project_member'=>$project_member]); 
        }else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]); 
        }
    }


    public function update(Request $request) {
        $input = $request->except(['id','project_member']);
         $validator = Validator::make($request->all(), [ 
            'code' => 'required',
            'customer_buy' => 'required',
            'customer_sell' => 'required', 
            'contact_date' => 'required', 
            'contract-term' => 'required',

        ]);
        if ($validator->fails()) { 
                    $errorString = implode("\r\n",$validator->messages()->all());
                    return response()->json(['error'=>$errorString]);                      
        }
        $input['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh');
         if($request->ship_name != null){
            $input['status'] = 2;           
        }
        $project = DB::table('project')->where('id',$request->id)->update($input);
        DB::table('project_member')->where('project_id',$request->id)->delete();
        if(count($request->project_member) >0){
        foreach($request->project_member as $member){
            $data['project_id'] = $request->id;
            $data['user_id'] = $member;
            $data['type_role'] = DB::table('user')->where('id', $member)->pluck('type')->first();
            DB::table('project_member')->insert($data);
        }
        }
        DB::table('lighter_detail')->where('project_id',$request->id)->delete();
        foreach( explode(',',$request->lighter_codes) as $lighter){
            $data1['project_id'] = $request->id;
            $data1['lighter_code'] = $lighter;
            DB::table('lighter_detail')->insert($data1);
        }
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
        DB::table('project')->where('id',$request->id)->delete();
        DB::table('project_member')->where('project_id',$request->id)->delete();
        return response()->json(['success' => 1]);
    }

    public function payment(Request $request) 
    {   
        $records = DB::table('payment')->get();
        return response()->json(['success' => 1,'records'=> $records]); 
    } 

    public function findByStatus(Request $request){
        $records = DB::table('project')->where('status',$request->status)->get();
        if($records){
             return response()->json(['success' => 1,'records'=> $records]); 
        }else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]);
        }
    }
 

}


    
