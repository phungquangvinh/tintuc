<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function list()
    {
    	$user = User::all();
    	return view('admin.user.list', ['user'=>$user]);
    }
    
    public function getEdit($id)
    {
    	$user = User::find($id);
    	return view('admin.user.edit',['user' => $user]);
    }

    public function postEdit(Request $request, $id)
    {
    	$user = User::find($id);
    	$this->validate($request, [
    		'Ten' => 'required|min:5|max:50',
    	],
    	[
    		'Ten.required' => 'Nhập tên user đê',
    		'Ten.min' => 'Tên quá ngắn, nghĩ tên nào dài ra đê',
    		'Ten.max' => 'Viết dài quá, xóa bớt đê',
    	]);

    	$user->name = $request->Ten;
    	$user->quyen = $request->quyen;

    	$user->save();
    	return redirect()->back()->with('thongbao', 'Sửa thông tin user thành công');
    }

    public function getDelete($id)
    {
    	$user = User::find($id);
    	$user -> delete();
    	return redirect('admin/user/list')->with('thongbao', 'Xóa user thành công');
    }

    public function getUser()
    {
        $user = Auth::user();
        return view('user.index',['user'=>$user]);
    }

    public function postUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5|max:50',
        ],
        [
            'name.required' => 'Nhập tên user đê',
            'name.min' => 'Tên quá ngắn, nghĩ tên nào dài ra đê',
            'name.max' => 'Viết dài quá, xóa bớt đê',
        ]);

        $user = Auth::user();
        $user->name = $request->name;

        if($request->checkpassword == "on"){
            $this->validate($request, [
                'password' => 'required|min:6',
                'passwordAgain' => 'required|same:password'
            ],
            [
                'password.required' => 'Không nhập mật khẩu à?',
                'password.min' => 'Mật khẩu phải từ 6 kí tự trở lên',
                'passwordAgain.required' => 'Chưa nhập lại mật khẩu',
                'passwordAgain.same' => 'Mật khẩu nhập lại không đúng'
            ]);
            $user->password = bcrypt($request->password);
        }

        $user->save();
        return redirect()->back()->with('thongbao', 'Sửa thông tin user thành công');
    }
}
