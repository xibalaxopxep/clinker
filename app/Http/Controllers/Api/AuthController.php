<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Repositories\UserRepository;
use Auth;

class AuthController extends Controller {

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function login(Request $request) {
        $remember = $request->get('remember');
        if (!isset($remember)) {
            $remember = false;
        }
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('marketing')->attempt(['username' => $request->username, 'password' => $request->password, 'status' => 1], $remember)) {
            session_start();
            $_SESSION['KCFINDER'] = []; //
            $_SESSION['KCFINDER'] = array('disabled' => false, 'uploadURL' => "/public/upload/m" . \Auth::guard('marketing')->user()->id);
            return response()->json([
                        'success' => true,
            ]);
        }
        return response()->json([
                    'success' => false,
        ]);
    }

    public function logout() {
        Auth::guard('marketing')->logout();
        return redirect()->route('home.index');
    }

    public function loginConstruction(Request $request) {
        $remember = $request->get('remember');
        if (!isset($remember)) {
            $remember = false;
        }
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('construction')->attempt(['username' => $request->username, 'password' => $request->password, 'status' => 1], $remember)) {
            session_start();
            $_SESSION['KCFINDER'] = []; //
            $_SESSION['KCFINDER'] = array('disabled' => false, 'uploadURL' => "/public/upload/m" . \Auth::guard('construction')->user()->id);
            return response()->json([
                        'success' => true,
            ]);
        }
        return response()->json([
                    'success' => false,
        ]);
    }

    public function logoutConstruction() {
        session_start();
        unset($_SESSION);
        session_destroy();
        Auth::guard('construction')->logout();
        return redirect()->route('home.index');
    }
     public function logoutMember() {
        session_start();
        unset($_SESSION);
        session_destroy();
        Auth::guard('member')->logout();
        return redirect()->route('home.index');
    }

}
