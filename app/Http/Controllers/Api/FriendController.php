<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 
use App\User;
use App\Friend;
use Validator;
use DB;

class FriendController extends Controller 
{
public $successStatus = 200;

    public function index(Request $request) 
    { 
        $user = Auth::user(); 
        $friend_ids = Friend::where('user_id',$user->id)->where('type',1)->get()->pluck('friend_id');
        $records = User::whereIn('id',$friend_ids)->get();
        return response()->json(['success' => 1,'records'=> $records], $this->successStatus); 
    } 
 
    public function request(Request $request) 
    { 
        $user = Auth::user(); 
        $friend_ids = Friend::where('user_id',$user->id)->where('type','=',0)->get()->pluck('friend_id');
        $records = User::join('friend','friend.friend_id','=','user.id')->where('friend.user_id',$user->id)->where('friend.type',0)->whereIn('user.id',$friend_ids)->select('*','friend.id as request_id','friend.type as type')->get();
        return $records;
        return response()->json(['success' => 1,'records'=> $records], $this->successStatus); 
    } 

    
     public function requested(Request $request) 
    { 
        $user = Auth::user(); 
        $records = User::join('friend','friend.friend_id','=','user.id')->where('friend.friend_id',$user->id)->where('friend.type',0)->select('*','friend.id as request_id','friend.type as type')->get();
        return response()->json(['success' => 1,'records'=> $records], $this->successStatus); 
    } 

    public function response(Request $request) 
    { 
        $user = Auth::user(); 
        $validator = Validator::make($request->all(), [ 
            // 'old_password' => 'required',
            'type' => 'required',
            'request_id' => 'required'
        ]);
        if ($validator->fails()) { 
                    $errorString = implode("\r\n",$validator->messages()->all());
                    return response()->json(['error'=>$errorString]);            
                }
        $record = Friend::find($request->request_id);
        if($record->type == 1){
        if($request->type == 1 && $record->type == 0){
        
        if(!$record){
            return response()->json(['success' => "0"], 404); 
        }
        $record->update(['type'=>$request->type]);
        Friend::create(['user_id'=>$record->friend_id,'friend_id'=>$record->user_id,'type'=>1]);
        return response()->json(['success' => 1], $this->successStatus); 
        }
        elseif($request->type == -1){
            Friend::find($request->request_id)->delete();
            return response()->json(['success' => 1], $this->successStatus); 
        }
        }else{
             return response()->json(['error' => "Người này đã là bạn bè"], $this->successStatus); 
        }
    }


}