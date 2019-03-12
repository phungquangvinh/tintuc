<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class TheLoaiController extends Controller
{
    public function getAdd()
    {
    	return view('admin.theloai.add');
    }
    public function postAdd(Request $request)
    {
    	$this->validate($request, [
    		'Ten' => 'required|min:10|max:100|unique:TheLoai,Ten'
    	],
    	[
    		'Ten.required' => 'Nhập tên đê',
    		'Ten.unique' => 'Tên có rồi, viết lại làm gì nữa',
    		'Ten.min' => 'Nhập thiếu rồi, trên 10 kí tự nhá',
    		'Ten.max' => 'Viết dài quá, xóa bớt đê'
    	]);

    	$theloai = new TheLoai;
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	$theloai->save();
    	return redirect('admin/the-loai/add')->with('thongbao', 'Thêm thành công');
    }

    public function getEdit($id)
    {
    	$theloai = TheLoai::find($id);
    	return view('admin.theloai.edit',['theloai' => $theloai]);
    }
    public function postEdit(Request $request,$id)
    {
    	$theloai = TheLoai::find($id);
    	$this->validate($request,[
    		'Ten' => 'required|unique:TheLoai,Ten|min:10|max:100'
    	],
    	[
    		'Ten.required' => 'Nhập đê tml',
    		'Ten.unique' => 'Tên có rồi, viết lại làm gì nữa',
    		'Ten.min' => 'Nhập thiếu rồi đmm',
    		'Ten.max' => 'Viết dài quá, xóa bớt đê'
    	]);

    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	$theloai->save();
    	return redirect('admin/the-loai/edit/'.$id)->with('thongbao', 'Sửa thành công');
    }

    public function getDelete($id)
    {
    	$theloai = TheLoai::find($id);
    	$theloai -> delete();
    	return redirect('admin/the-loai/list')->with('thongbao', 'Xóa thành công');
    }

    public function list()
    {
    	$theloai = TheLoai::all();
    	return view('admin.theloai.list', ['theloai' => $theloai]);
    }
}
