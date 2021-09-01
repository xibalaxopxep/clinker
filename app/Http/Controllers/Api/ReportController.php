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


class ReportController extends Controller {


    public $successStatus = 200;

    public function index(Request $request){
        $records = DB::table('report_detail')->where('timeline_id',$request->id)->orderBy('id','desc')->get();
        foreach ($records as $key => $item)
        {
            $records[$key]->user = DB::table('user')->where('id',$item->user_id)->get();
            $records[$key]->status_name = DB::table('report')->where('id',$item->status_id)->value('name');
            
            $records[$key]->weather_name = DB::table('weather')->where('id',$item->weather_id)->value('name');
            $records[$key]->lighter_code = DB::table('lighter_detail')->where('id',$item->lighter_id)->value('lighter_code');
        }
        if($records){
             return response()->json(['success' => 1,'records'=> $records]); 
        }else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]);
        }
    }
    public function findByProject(Request $request){
        $project_detail = DB::table('project_detail')->select('id')->where('project_id',$request->id)->get();
        $array_timeline = [];
        foreach ($project_detail as $key => $item)
        {
            array_push($array_timeline, $item->id);
        }
        $records = DB::table('report_detail')->whereIn('timeline_id',$array_timeline)->get();
        if($records){
             return response()->json(['success' => 1,'records'=> $records]); 
        }else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]);
        }
    }
    public function create(Request $request){
        $input = $request->all();
 //       if ($request->hasFile('image')) {
//            $image = $request->file('image');
//            return $image;
//        }
        $input['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');
       
        // update lighter
        $lighter = [];
        if ($input['status_id']>0 && $input['status_id']<7)
        {
            if ($input['status_id'] == 1)
            {
                $lighter['check_in']=Carbon::now('Asia/Ho_Chi_Minh');
            }
            elseif ($input['status_id'] == 2)
            {
                $lighter['check_out'] = Carbon::now('Asia/Ho_Chi_Minh');
            }
            elseif ($input['status_id'] == 3)
            {
                $lighter['cont_start_date'] = Carbon::now('Asia/Ho_Chi_Minh');
            }
            elseif ($input['status_id'] == 4)
            {
                $lighter_record = DB::table('lighter_detail')->where('id',$request->lighter_id)->first();
                $lighter['difference'] = abs($lighter_record->product_quantity - $input['real_quantity']);
                $lighter['cont_end_date'] = Carbon::now('Asia/Ho_Chi_Minh');
            }
            elseif ($input['status_id'] == 5)
            {
                $lighter['join_date'] = Carbon::now('Asia/Ho_Chi_Minh');
            }
            elseif ($input['status_id'] == 6)
            {
                $lighter['out_date'] = Carbon::now('Asia/Ho_Chi_Minh');
            }
            $lighter['product_quantity'] = $input['real_quantity'];
            $lighter['cont_number'] = $input['cont_number'];
            $lighter_query = DB::table('lighter_detail')->where('id',$request->lighter_id)->update($lighter);
            //unset($input['status_id']);
            
        }
        // check nếu là báo cáo bất thường
         if ($input['is_unusual'])
        {
            $project = DB::table('project_detail')->where('id',$request->project_id)->first();
            $report = DB::table('report')->where('id',$request->status_id)->first();
            $project->is_unusual = 1;
            $project->title = $report->name;
            $project->description = $request->note;
            $project->deadline = Carbon::now('Asia/Ho_Chi_Minh');
            $project->project_id = $request->project_id;
            $project = (array)$project;
            
            unset($project['id']);
            unset($project['updated_at']);
            $timeline = DB::table('project_detail')->insert($project);
            //return response()->json(['success' => $project]); 
        }
        unset($input['project_id']);
        $input['user_id'] = \Auth::user()->id;
        $records = DB::table('report_detail')->insert($input);
        
        if($records){
             return response()->json(['success' => 1]); 
        }else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]);
        }
    }
}


    
