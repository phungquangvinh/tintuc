<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
	function __construct()
    {
        if (Auth::check()) {
        	view()->share('nguoidung',Auth::user());
        }
    }
    public function getLogin() {
        return view('dangnhap');
    }
    public function postLogin(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');

        if( Auth::attempt(['email' => $email, 'password' =>$password])) {
            if(Auth::check()){
	            $user = Auth::user();
	            if ($user->quyen == 1) {
	                return redirect('admin');
	            }
	            else return redirect('/');
	        }
	        else return redirect('dangnhap');
        } 
        else {                
            return redirect('dangnhap')->with('thongbao','Đăng nhập ko thành công!');
        }
    }
}
