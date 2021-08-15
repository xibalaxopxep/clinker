<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 
use DB;

use Validator;

class AddressController extends Controller 
{
public $successStatus = 200;

       public function index(Request $request) 
    { 
        
        $records = DB::table('address')->get();
        return response()->json(['success' => 1,'records'=> $records], $this->successStatus); 
    } 
 
  

}