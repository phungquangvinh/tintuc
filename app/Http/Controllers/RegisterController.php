<?php

namespace App\Http\Controllers;

use App\User;
use App\Comment;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function getRegister()
    {
    	return view('auth.dangki');
    }

    public function postRegister(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
    	],
    	[
    		'name.required' => 'Họ và tên là trường bắt buộc',
            'name.max' => 'Họ và tên không quá 255 ký tự',
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email không quá 255 ký tự',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không đúng',
    	]);

    	$user = new User;
    	$user->name = $request->name;
    	
    	if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
	      return redirect('/dangki')->with('thongbao', 'Sorry, email của bạn ko đúng định dạng!');
	    } else $user->email = $request->email;

    	$user->password = bcrypt($request->password);
    	$user->quyen = '0';
    	$user->save();
    	return redirect('/dangki')->with('thongbao', 'Thêm thành công');
    }
}
