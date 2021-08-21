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

     public function uploadImage(Request $request) 
    { 
        $input = $request->except('id');
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpg,png,jpeg,gif',
        ]);
        if ($validator->fails()) { 
                    $errorString = implode("\r\n",$validator->messages()->all());
                    return response()->json(['error'=>$errorString]);                      
        }
        $record = DB::table('project_detail')->where('id',$request->id)->first();
        $get_image=$request->image;
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('img/',$new_image);
            if($record->images == null){
                 $input['images'] = '/img/'.$new_image;
            }else{
                 $input['images'] = $record->images.',/img/'.$new_image;
            }
        }
        unset($input['image']);
        $user = DB::table('project_detail')->where('id',$request->id)->update($input);
        return response()->json(['success'=>1]); 
    } 

    public function deleteImage(Request $request) 
    { 
        $input = $request->except('id');
        $validator = Validator::make($request->all(), [
            'image' => 'required',
        ]);
        if ($validator->fails()) { 
                    $errorString = implode("\r\n",$validator->messages()->all());
                    return response()->json(['error'=>$errorString]);                      
        }
        $record = DB::table('project_detail')->where('id',$request->id)->first();
        $index = explode(',', $record->images);
        foreach($index as $key => $value){
            if($value == $request->image){
                unset($index[$key]);
            }
        }
        $index = implode(',', $index);
        $user = DB::table('project_detail')->where('id',$request->id)->update(['images'=>$index]);
        return response()->json(['success'=>1]); 
    } 

    public function index(Request $request) {
        $host = $request->getSchemeAndHttpHost();
        $records = DB::table('project_detail')->where('project_id',$request->project_id)->orderBy('deadline','asc')->get();
        foreach($records as $key => $record){
            $image = array();
            if($record->images != null){
                foreach( explode(',',$record->images) as $rd ){
                     $image[] =  $host.$rd;
                }
                $records[$key]->images = $image;
            }
        }
        // foreach($records as $key => $record){
        //     $groups = DB::table('group')->where('group_name',$record->group_name)->get();
        //     $records[$key]->group_name = $groups;
        // }

        return response()->json(['success' => 1,'records'=>$records]); 
    }

   
    public function show(Request $request) {
        $record = DB::table('project_detail')->where('id',$request->id)->first();
        $works = DB::table('type_work')->get();
        foreach ($works as $work) {
            if($work->id == $record->work_id){
                $record->work_name = $work->name;
                break;
            }
        }
        $lighters = DB::table('lighter_detail')->get();
        foreach ($lighters as $lighter) {
            if($lighter->id == $record->lighter_id){
                $record->lighter_name = $lighter->lighter_code;
                break;
            }
        }

        if($record){
           return response()->json(['success' => 1,'record'=>$record]); 
        }else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]); 
        }
    }


    public function update(Request $request) {
         $input = $request->except('id');
         $record = DB::table('project_detail')->where('id',$request->id)->first();
        //  $validator = Validator::make($input, [ 
        //     'quantity' => 'required',
        //     'real_quantity' => 'required', 
        //     'cont_number' => 'required',
        //     'product_quantity' => 'required',
        //     'weather_id' => 'required',
        //     'reporting_time' => 'required',
        //     'status_content' =>'required',
        // ]);
        // if ($validator->fails()) { 
        //         $errorString = implode("\r\n",$validator->messages()->all());
        //         return response()->json(['error'=>$errorString]);                 
        // }

     
        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $record->deadline);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $input['reporting_time']);
        $diff_in_days = $to->diffInSeconds($from);
        if($diff_in_days <= 1800){
            $input['status'] = 1;
        }else{
            $input['status'] = 2;
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

    public function getWeather(Request $request) {

        $records = DB::table('weather')->get();
        return response()->json(['success' => 1,'records'=>$records]);
    }


    public function getTypeWork(Request $request){
        $records = DB::table('type_work')->get();
        if($records){
             return response()->json(['success' => 1,'records'=> $records]); 
        }else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]);
        }
    }

   

}


    
