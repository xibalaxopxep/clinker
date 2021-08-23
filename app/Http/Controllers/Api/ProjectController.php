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
        $user = Auth::user();

            if($user->type == 1){
                $records = DB::table('project')->get();
                return response()->json(['success' => 1,'records'=>$records], $this->successStatus); 
            }
            elseif($user->type == 2 || $user->type == 4 ){
                $project_id = DB::table('project_member')->where('user_id',$user->id)->get()->pluck('project_id');
                $records = DB::table('project')->whereIn('id',$project_id)->get();
                return response()->json(['success' => 1,'records'=>$records], $this->successStatus); 
            }
            else{
                $project_id = DB::table('project_group')->where('user_id',$user->id)->get()->pluck('project_id');
                $records = DB::table('project')->whereIn('id',$project_id)->get();
                return response()->json(['success' => 1,'records'=>$records], $this->successStatus); 
            }
    }



    public function store(Request $request) {
        $input = $request->except(['project_member','project_group','manage_id']);
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
            $input['status_id'] = 1;
        }else{
            $input['status_id'] = 2;
        }
        $project = DB::table('project')->insertGetId($input);

        if($request->has("project_member")){
        foreach($request->project_member as $member){
            $data['project_id'] = $project;
            $data['user_id'] = $member;
            $data['type_role'] = DB::table('user')->where('id', $member)->pluck('type')->first();
            DB::table('project_member')->insert($data);
        }
        }


        if($request->has("lighter_codes") || $request->has("lighter_codes") != null){

        foreach( explode(',',$request->lighter_codes) as $lighter){
            $data1['project_id'] = $project;
            $data1['lighter_code'] = $lighter;
            DB::table('lighter_detail')->insert($data1);
        }
        }

        if ($project) {
             return response()->json(['success' => 1]); 
        }else {
            return response()->json(['success' => 0]); 
        }
    }


    public function show(Request $request) {
        $record = DB::table('project')->where('id',$request->id)->first();
        $project_member = DB::table('project_member')->join('user','user.id','=','project_member.user_id')->where('project_member.project_id',$request->id)->get();
        $host = $request->getSchemeAndHttpHost();
        foreach($project_member as $key => $member){
             $project_member[$key]->avatar = $host . $member->avatar;
        }
        //$address_arr = explode(',',$record->address_id);
        // $arr_tmp = array();
        // foreach ($address_arr as $key => $item)
        // {
        //     $address = DB::table('address')->where('id',$item)->first();
        //     array_push($arr_tmp,$address);
        // }
        // $record->address = $arr_tmp;
        if($record){
           return response()->json(['success' => 1,'record'=>$record,'project_member'=>$project_member]); 
        }else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]); 
        }
    }


    public function update(Request $request) {
        $input = $request->except(['id','project_member','project_group','manage_id']);
        // $validator = Validator::make($request->all(), [ 
        //     'code' => 'required',
        //     'customer_buy' => 'required',
        //     'customer_sell' => 'required', 
        //     'contact_date' => 'required', 
        //     'contract-term' => 'required',

        // ]);
        // if ($validator->fails()) { 
        //             $errorString = implode("\r\n",$validator->messages()->all());
        //             return response()->json(['error'=>$errorString]);                      
        // }
        $input['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        if($request->ship_name == null){
            $input['status_id'] = 1;
        }else{
            $input['status_id'] = 2;
        }
        $project = DB::table('project')->where('id',$request->id)->update($input);
        if($request->has("project_member")){
        DB::table('project_member')->where('project_id',$request->id)->delete();
        foreach($request->project_member as $member){
            $data['project_id'] = $request->id;
            $data['user_id'] = $member;
            $data['type_role'] = DB::table('user')->where('id', $member)->pluck('type')->first();
            DB::table('project_member')->insert($data);
        }
        }
        if($request->has("lighter_codes") || $request->has("lighter_codes")!=null){
        DB::table('lighter_detail')->where('project_id',$request->id)->delete();
        foreach( explode(',',$request->lighter_codes) as $lighter){
            $data1['project_id'] = $request->id;
            $data1['lighter_code'] = $lighter;
            DB::table('lighter_detail')->insert($data1);
        } 
        }
        if($request->has("project_group") || $request->has("project_group") != null){
        DB::table('project_group')->where('project_id',$request->id)->delete();
        $index = 0;
        foreach($request->project_group as $key => $group){
            foreach ($group as $key1 => $gr) {
                $data2['project_id'] = $request->id;
                $data2['group_name'] = $key;
                $data2['user_id'] = $gr;
                if($request->manage_id[$key] == $gr){
                    $data2['is_manage'] = 1;
                }else{
                    $data2['is_manage'] = 0;
                }
                if($index >0){
                $record = DB::table('project_group')->where('project_id',$request->id)->get()->pluck('user_id')->toArray();
                if (in_array($gr, $record) == false ) {
                     DB::table('project_group')->insert($data2);
                }
                }
                else{
                    DB::table('project_group')->insert($data2);
                }
            
             }
             $index++;
            }  
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
         $user = Auth::user();
            if($user->type == 1){
                $records = DB::table('project')->where('status_id',$request->status)->get();
                return response()->json(['success' => 1,'records'=>$records], $this->successStatus); 
            }
            elseif($user->type == 2 || $user->type == 4){
                $project_id = DB::table('project_member')->where('user_id',$user->id)->get()->pluck('project_id');
                $records = DB::table('project')->where('status_id',$request->status)->whereIn('id',$project_id)->get();
                return response()->json(['success' => 1,'records'=>$records], $this->successStatus); 
            }
            else{
                $project_id = DB::table('project_group')->where('user_id',$user->id)->get()->pluck('project_id');
                $records = DB::table('project')->where('status_id',$request->status)->whereIn('id',$project_id)->get();
                return response()->json(['success' => 1,'records'=>$records], $this->successStatus); 
            }
        
        if($records){
             return response()->json(['success' => 1,'records'=> $records]); 
        }else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]);
        }
    }

    public function getStatus(Request $request){
        $records = DB::table('status')->get();
        if($records){
             return response()->json(['success' => 1,'records'=> $records]); 
        }else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]);
        }
    }

    public function listLighters(Request $request){
        $records = DB::table('lighter_detail')->where('project_id', $request->project_id)->get();
        if($records){
             return response()->json(['success' => 1,'records'=> $records]); 
        }else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]);
        }
    }

    public function getGroup(Request $request){
        $records = DB::table('project_group')->where('project_id', $request->project_id)->where('is_manage',0)->orderBy('group_name','asc')->get()->groupBy('group_name');
        $records2 = DB::table('project_group')->where('project_id', $request->project_id)->where('is_manage',1)->orderBy('group_name','asc')->get();
        if($records){
        $member = [];
        $member1 = [];
        foreach($records as $key => $record){
            $member['manage'] = $records2[$key-1];
            $member['member'] = $record;
            $member1[] = $member;
        }
       
        return response()->json(['success' => 1,'records'=> $member1]); 
        }
         else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]);
        }
    }

    public function group(Request $request){
        $host = $request->getSchemeAndHttpHost();
        $records = DB::table('project_group')->join('user','user.id','=','project_group.user_id')->where('project_group.project_id',$request->project_id)->where('project_group.is_manage',0)->orderBy('project_group.group_name','asc')->get()->groupBy('group_name');
        $records2 = DB::table('project_group')->join('user','user.id','=','project_group.user_id')->where('project_group.project_id',$request->project_id)->where('project_group.is_manage',1)->orderBy('project_group.group_name','asc')->get();
        if($records){
        foreach($records as $record){
            foreach($record as $key=> $re){
                $record[$key]->avatar =  $host.$re->avatar;
            }
        }
        $member = [];
        $member1 = [];
        foreach($records as $key => $record){
            if(count($records2) == 1){
                if($key == $records2->pluck('group_name')[0]){
                     $member['manage'] = $records2;
                }
                else{
                    $member['manage'] = "";
                }
            }
            else{
            if(!empty($records2[$key-1])){
                $member['manage'] = $records2[$key-1];
            }
            }
            $member['member'] = $record;
            $member1[] = $member;
        }
        
        return response()->json(['success' => 1,'records'=> $member1]); 
        }
        else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]);
        }
    }
}


    
