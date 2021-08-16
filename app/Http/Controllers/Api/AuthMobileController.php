<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Repositories\UserRepository;
use Illuminate\Support\Facades\Auth; 
use App\User;
use Validator;
use App\Friend;

class AuthMobileController extends Controller 
{
public $successStatus = 200;
 
    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }    

    public function login(Request $request){ 
        if(Auth::attempt(['email' => $request->email, 'password' =>  $request->password])){ 
            $user = Auth::user();
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
   
    public function detail() 
    { 
        $user = Auth::user(); 
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
                    return response()->json(['error'=>$validator->errors()], 401);            
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
                    return response()->json(['error'=>$validator->errors()], 401);            
                }
        $input = $request->all();
        $input['user_id'] = $user->id;
        $input['type'] = 0;
        Friend::create($input);   
        return response()->json(['success' => 1], $this->successStatus); 
    } 


}