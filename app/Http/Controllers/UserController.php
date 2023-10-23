<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use Auth;
use App\Http\Requests\Fe\RegisterPostRequest;
use App\Http\Requests\Fe\LoginPostRequest;

class UserController extends Controller
{
    public function login() {
        return view('fe.login');
    }
    public function register() {
        return view('fe.register');
    }
    public function registerPost(RegisterPostRequest $req) {
        $req->merge(['password'=>Hash::make($req->password)]);
        try {
            User::create($req->all());
        } catch (\Throwable $th) {
            dd($th);
        }
        return redirect()->route('login');
    }
    public function loginPost(LoginPostRequest $req) {
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
            if (isset($req->remember) && !empty($req->remember)) {
                setcookie("email",$req->email,time()+3600);
                setcookie("password",$req->password,time()+3600);
            }else{
                setcookie("email","");
                setcookie("password","");
            }
            return redirect()->route('user');
        }
            return redirect()->back()->with('err','Your account is incorrect');
    }
    public function loginout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
