<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\StringHelper;
use DB;
use Carbon\Carbon;


class ProjectController extends Controller {

   
    public function list(Request $request) {
       $records = DB::table('project')->get();
       if($records){
             return response()->json(['success'=>1, 'records'=>$records]);
          }
          else{
              return response()->json(['success'=>0]);
          }
    }

     public function detail(Request $request) {
          $id = $request->project_id;
          $record = DB::table('project')->where('id',$id)->first();
          if($record){
             $project_details = DB::table('project_detail')->where('project_id',$record->id)->get();
             return response()->json(['success'=>1, 'record'=>$record,'project_details'=>$project_details]);
          }
          else{
              return response()->json(['success'=>0]);
          }
    }





}
