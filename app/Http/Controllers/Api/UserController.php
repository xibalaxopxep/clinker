<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 
use App\User;
use App\Friend;
use Validator;
use DB;


class UserController extends Controller {

     public function index(Request $request) {
        $user = Auth::user(); 
        //$friend_ids = Friend::where('user_id',$user->id)->where('type',0)->get()->pluck('friend_id');
        $records = User::join('friend','friend.friend_id','=','user.id')->where('friend.user_id',$user->id)->whereIn('user.type',[2,4])->select('*','friend.id as request_id')->select('*', 'user.type as type')->get();
        if($records){
        return response()->json(['success' => 1,'records'=> $records]); 
        }else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]); 
        }
    }

      public function member(Request $request) {
        $user = Auth::user(); 
        //$friend_ids = Friend::where('user_id',$user->id)->where('type',0)->get()->pluck('friend_id');
        $records = User::join('friend','friend.friend_id','=','user.id')->where('friend.user_id',$user->id)->where('user.type',3)->select('*','friend.id as request_id')->select('*', 'user.type as type')->get();
        if($records){
        return response()->json(['success' => 1,'records'=> $records]); 
        }else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]); 
        }
    }

     public function findByEmail(Request $request) {
        $user = Auth::user(); 
        $record = User::join('friend','friend.friend_id','=','user.id')->where('user.email', 'LIKE', '%' . $request->email . '%')->where('friend.user_id',$user->id)->whereIn('user.type',[2,4])->select('*', 'user.type as type', 'user.id as id')->get();
    
  
        if($record){
        return response()->json(['success' => 1,'records'=> $record]); 
        }else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]); 
        }
    }





}
