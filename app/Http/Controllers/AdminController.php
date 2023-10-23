<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class AdminController extends Controller
{
    public function logon() {
        
        return view('admin.logon');
    }
    public function logonstore(Request $req) {
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password,'role'=>1])) {
            return redirect()->route('user.index');
        }
        return redirect()->back()->with('err','Your account is incorrect');
    }
    public function logonout() {
        Auth::logout();
        return redirect()->route('logon');
    }
}
