<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\StringHelper;
use DB;
use Carbon\Carbon;


class UserController extends Controller {

   
 

     public function show(Request $request) {
          $id = $request->id;
          $record = DB::table('user')->where('id',$id)->first();
          if($record){
             return response()->json(['success'=>1, 'record'=>$record]);
          }
          else{
              return response()->json(['success'=>0]);
          }
    }





}
