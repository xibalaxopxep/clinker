<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Repositories\UserRepository;
use Illuminate\Support\Facades\Auth; 
use App\User;
use Validator;
use App\Friend;
use DB;

class AuthMobileController extends Controller 
{
public $successStatus = 200;
 
    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }    

    public function login(Request $request){ 
        $host = $request->getSchemeAndHttpHost();
        if(Auth::attempt(['email' => $request->email, 'password' =>  $request->password])){ 
            $user = Auth::user();
            $user->avatar = $host.$user->avatar;
            if($user->status == 1){
        
            return response()->json(['success' => 1 , 'token'=> $user->createToken('Token')->accessToken,'user'=>$user], $this->successStatus); 
            }
            else{
                return response()->json(['error'=>'Tài khoản chưa được xét duyệt']); 
            }
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'full_name' => 'required',
            'username' => 'required|unique:user',
            'email' => 'required|email|unique:user', 
            'password' => 'required|min:6|max:32', 
            'c_password' => 'required|same:password', 
        ]);
        if ($validator->fails()) {
                    $errorString = implode("\r\n",$validator->messages()->all());
                    return response()->json(['error'=>$errorString]);           
                }
        $input = $request->except('c_password'); 
                $input['status'] = 0; 
                $input['password'] = bcrypt($input['password']); 
                $input['type'] = 3; 
                $user = User::create($input); 
                $success['token'] =  $user->createToken('Token')->accessToken; 
                $success['name'] =  $user->full_name;
        return response()->json(['success'=>1], $this->successStatus); 
    }
    
    public function list() 
    { 
        $users = User::all(); 
        return response()->json(['success' => 1, 'users'=>$users], $this->successStatus); 
    } 
   
    public function detail(Request $request) 
    { 
        $user = Auth::user(); 
        $host = $request->getSchemeAndHttpHost();
        $user['avatar'] = $host . $user->avatar;
        return response()->json(['success' => 1, 'user'=>$user], $this->successStatus); 
    } 

    
    public function update(Request $request) 
    { 
         $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'username' => 'required|unique:user,username,' . Auth::user()->id . ',id',
            'email' => 'required|email|unique:user,email,' . Auth::user()->id . ',id', 
            'birthday' => 'before:today',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        } 
        $input = $request->all(); 
        $get_image=$request->avatar;
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('img/',$new_image);
            $input['avatar'] = '/img/'.$new_image;
        }
        $user = User::find(Auth::user()->id)->update($input);
        $user = User::find(Auth::user()->id); 
        return response()->json(['success'=>1, 'user'=>$user], $this->successStatus); 
    } 

      public function change_password(Request $request) 
    { 
        $user = Auth::user(); 
        $validator = Validator::make($request->all(), [ 
            // 'old_password' => 'required',
            'password' => 'required|min:6|max:32', 
            'c_password' => 'required|same:password', 
        ]);
        if ($validator->fails()) { 
                    $errorString = implode("\r\n",$validator->messages()->all());
                    return response()->json(['error'=>$errorString]);                  
                }

        // if($user->password != bcrypt($request->old_password)){
        //         return response()->json(['error'=>"Mật khẩu không chính xác"], 401);       
        // }     
        User::find($user->id)->update(['password'=> bcrypt($request->password)]);
        return response()->json(['success' => 1, 'user'=>$user], $this->successStatus); 
    } 


    public function request(Request $request) 
    { 
        $user = Auth::user(); 
        $validator = Validator::make($request->all(), [ 
            // 'old_password' => 'required',
            'friend_id' => 'required', 
        ]);
        if ($validator->fails()) { 
                    $errorString = implode("\r\n",$validator->messages()->all());
                    return response()->json(['error'=>$errorString]);             
                }
        $input = $request->all();
        $input['user_id'] = $user->id;
        $input['type'] = 0;
        Friend::create($input);   
        return response()->json(['success' => 1], $this->successStatus); 
    } 

    // public function response(Request $request) 
    // { 
    //     $user = Auth::user();
    //     $type = $ 
    //     $validator = Validator::make($request->all(), [ 
    //         // 'old_password' => 'required',
    //         'type' => 'required', 
    //     ]);
    //     if ($validator->fails()) { 
    //                $errorString = implode("\r\n",$validator->messages()->all());
    //                return response()->json(['error'=>$errorString]);      
    //             }
    //     $input = $request->all();
    //     $input['user_id'] = $user->id;
    //     $input['type'] = 0;
    //     Friend::create($input);   
    //     return response()->json(['success' => 1], $this->successStatus); 
    // } 


    public function findByEmail(Request $request) {
        $user = Auth::user(); 
        $record_friends = User::join('friend','friend.friend_id','=','user.id')->where('email', 'LIKE', '%' . $request->email . '%')->where('friend.user_id',$user->id)->select('*', 'user.id as id','friend.type as friend_type')->get();
        $record_users = User::where('email', 'LIKE', '%' . $request->email . '%')->where('id','!=',$user->id)->whereNotIn('id',$record_friends->pluck('id'))->get();
        if($record_users || $record_friends){
        return response()->json(['success' => 1, 'is_friends'=>$record_friends ,'not_friends' => $record_users]); 
        }else{
            return response()->json(['error' => "Không tìm thấy dữ liệu"]); 
        }
    }

    public function upload_image(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            $errorString = implode("\r\n",$validator->messages()->all());
            return response()->json(['error'=>$errorString]); 
        }
        $get_image = $request->file('avatar');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('img/user/',$new_image);
            $data['avatar'] = '/img/user/'.$new_image;
        }
        DB::table('user')->where('id',Auth::user()->id)->update(['avatar'=>$data['avatar']]);
        $avatar = DB::table('user')->where('id',Auth::user()->id)->pluck('avatar')->first();
        if($avatar){
             $host = $request->getSchemeAndHttpHost();
            return response()->json(['success' => 1, 'avatar'=> $host . $avatar]); 
        }else{
            return response()->json(['error' => "Có lỗi trong quá trình xử lý"]); 
        }
    }




}