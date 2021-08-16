<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 
use App\User;
use App\Friend;
use Validator;

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
        $friend_ids = Friend::where('user_id',$user->id)->where('type',0)->get()->pluck('friend_id');
        $records = User::join('friend','friend.friend_id','=','user.id')->whereIn('user.id',$friend_ids)->select('*','friend.id as request_id')->get();
        return response()->json(['success' => 1,'records'=> $records], $this->successStatus); 
    } 

    public function response(Request $request, $request_id) 
    { 
        $user = Auth::user(); 
        $validator = Validator::make($request->all(), [ 
            // 'old_password' => 'required',
            'type' => 'required', 
        ]);
        if ($validator->fails()) { 
                    return response()->json(['error'=>$validator->errors()], 401);            
                }
        $record = Friend::find($request_id);
        if($request->type == 1 && $record->type == 0){
        
        if(!$record){
            return response()->json(['success' => "0"], 404); 
        }
        $record->update(['type'=>$request->type]);
        Friend::create(['user_id'=>$record->friend_id,'friend_id'=>$record->user_id]);
        return response()->json(['success' => 1], $this->successStatus); 
        }elseif($request->type == -1){
            Friend::find($request_id)->delete();
            return response()->json(['success' => 1], $this->successStatus); 
        }
    }


}