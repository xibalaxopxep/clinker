<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Repositories\UserRepository;

class AuthController extends Controller {

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin() {
        return view('backend.auth.login');
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     */
    public function postLogin(Request $request) {
        $input = [
            'username' => $request->get('username'),
            'password' => $request->get('password')
        ];

        if (Auth::attempt($input)) {
            $user = Auth::user();
            $user->save();
            session_start();
            $_SESSION['KCFINDER'] = []; //
            $_SESSION['KCFINDER'] = array('disabled' => false, 'uploadURL' => "/public/upload");
            return Redirect::route('admin.index');
        }
        return Redirect::route('login')->with('error', 'Wrong login account');
    }

    /**
     *
     * @return type
     */
    public function logout() {
        session_start();
        unset($_SESSION);
        session_destroy();
        Auth::logout();
        return Redirect::route('login');
    }

}
