<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\StringHelper;
use DB;
use Carbon\Carbon;


class ProjectDetailController extends Controller {

   


     public function detail(Request $request) {
          $id = $request->id;
          $record = DB::table('project_detail')->where('id',$id)->first();
          if($record){       
             return response()->json(['success'=>1, 'record'=>$record]);
          }
          else{
              return response()->json(['success'=>0]);
          }
    }





}
