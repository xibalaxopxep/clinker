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

        $records = DB::table('project_detail')->where('project_id',$request->project_id)->orderBy('deadline','asc');

        if($request->groupName != null){
            $records->where('group_name',$request->groupName);
        }
       // if($request->user_id != null){
//            $records->where('user_id',$request->user_id);
//        }
//       
        if($request->date != null){
            $from = $request->date." 00:00:00";
            $to = $request->date." 23:59:59";
            $records->whereBetween('deadline', [$from, $to]);
        }else{
            $records->whereDate('deadline', Carbon::now('Asia/Ho_Chi_Minh'));
        }
        $records = $records->get();
        $works = DB::table('type_work')->get();
        $reports = DB::table('report')->get();
        //$lighters = DB::table('lighter_detail')->get();
        $host = $request->getSchemeAndHttpHost();
        foreach($records as $key =>$record){    
                    $records[$key]->work_name = "";
                    //$records[$key]->lighter_name = "";
                    foreach ($works as $work) {
                        if($work->id == $record->work_id){
                            $records[$key]->work_name = $work->name;
                            break;
                        }
                    }

                    foreach ($reports as $report) {
                        if($report->id == $record->report_id){
                            $records[$key]->report_name = $report->name;
                            break;
                        }
                    }
                    // foreach ($lighters as $lighter) {
                    //     if($lighter->lighter_code == $record->lighter_code){
                    //         $records[$key]->lighter_name = $lighter->lighter_code;
                    //         break;
                    //     }
                    // }
                     $image = array();
                    if($record->images != null){
                        foreach( explode(',',$record->images) as $rd ){
                             $image[] =  $host.$rd;
                        }
                        $records[$key]->images = $image;
                    }
                        
        }
        if($request->isGop == 1){
             $records= $records->groupBy('deadline');
        }
        return response()->json(['success' => 1,'records'=>$records]); 
    }

   
    public function show(Request $request) {
        $record = DB::table('project_detail')->where('id',$request->id)->first();
        $record->work_name = "";
        $record->lighter_name = "";
        $works = DB::table('type_work')->get();
        $reports = DB::table('report')->get();
        foreach ($works as $work) {
            if($work->id == $record->work_id){
                $record->work_name = $work->name;
                break;
            }
        }

        foreach ($reports as $report) {
            if($report->id == $record->report_id){
                $records[$key]->report_name = $report->name;
                break;
            }
        }
        // $lighters = DB::table('lighter_detail')->get();
        // foreach ($lighters as $lighter) {
        //     if($lighter->lighter_code == $record->lighter_code){
        //         $record->lighter_name = $lighter->lighter_code;
        //         break;
        //     }
        // }
        $host = $request->getSchemeAndHttpHost();
        $index = array();
        foreach(explode(',',$record->images) as $key=> $img){
              $index[] = $host . $img;
        }
        $record->images = $index;

        if($record){
           return response()->json(['success' => 1,'record'=>$record]); 
        }else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]); 
        }
    }


    public function update(Request $request) {
        $input = $request->except(['id','image','isBatThuong']);
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
        $input['reporting_time'] = Carbon::now('Asia/Ho_Chi_Minh');
        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $record->deadline);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $input['reporting_time']);
        $diff_in_days = $to->diffInSeconds($from);
        if($request->isBatThuong != 1){
        if($diff_in_days <= 1800){
            $input['status'] = 1;
        }else{
            $input['status'] = 2;
        }
        }else{
            $input['status'] = 3;
        }
        $input['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh');
        $get_image = $request->image;
        if($get_image){
            foreach ($get_image as $key =>$item)
            {
                $get_name_image = $item->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image =  $name_image.rand(0,99).'.'.$item->getClientOriginalExtension();
                $item->move('img/',$new_image);
                if($record->images == null){
                     $image_path = '/img/'.$new_image;
                }else{
                     $image_path = $record->images.',/img/'.$new_image;
                }
                $input['images'] = $input['images'].$image_path.',';
            }
        }
        $input['lighter_code'] = DB::table('lighter_detail')->where('id',$request->lighter_id)->value('lighter_code');
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

      public function getReport(Request $request) {

        $records = DB::table('report')->get();
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


    
