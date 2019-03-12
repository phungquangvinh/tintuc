<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;

class LoaiTinController extends Controller
{
    public function getAdd()
    {
    	$theloai = TheLoai::all();
    	return view('admin.loaitin.add',['theloai' => $theloai]);
    }
    public function postAdd(Request $request)
    {
    	$this->validate($request, [
    		'Ten' => 'required|min:5|max:50|unique:LoaiTin,Ten',
    		'ChonTheLoai' => 'required'
    	],
    	[
    		'Ten.required' => 'Nhập đê tml',
    		'Ten.unique' => 'Tên có rồi, viết lại làm gì nữa',
    		'Ten.min' => 'Nhập thiếu rồi đmm',
    		'Ten.max' => 'Viết dài quá, xóa bớt đê',
    		'ChonTheLoai.required' => 'Dell chọn thể loại à dmm'
    	]);

    	$loaitin = new LoaiTin;
    	$loaitin->Ten = $request->Ten;
    	$loaitin->TenKhongDau = changeTitle($request->Ten);
    	$loaitin->idTheLoai = $request->ChonTheLoai;
    	$loaitin->save();
    	return redirect()->back()->with('thongbao', 'Thêm thành công');
    }

    public function getEdit($id)
    {
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::find($id);
    	return view('admin.loaitin.edit',['loaitin' => $loaitin, 'theloai'=>$theloai]);
    }
    public function postEdit(Request $request,$id)
    {
    	$loaitin = LoaiTin::find($id);
    	$this->validate($request,[
    		'Ten' => 'required|min:5|max:50|unique:LoaiTin,Ten',
    		'ChonTheLoai' => 'required'
    	],
    	[
    		'Ten.required' => 'Nhập đê tml',
    		'Ten.unique' => 'Tên có rồi, viết lại làm gì nữa',
    		'Ten.min' => 'Nhập thiếu rồi đmm',
    		'Ten.max' => 'Viết dài quá, xóa bớt đê',
    		'ChonTheLoai.required' => 'Dell chọn thể loại à dmm'
    	]);

    	$loaitin->Ten = $request->Ten;
    	$loaitin->TenKhongDau = changeTitle($request->Ten);
    	$loaitin->idTheLoai = $request->ChonTheLoai;
    	$loaitin->save();
    	return redirect()->back()->with('thongbao', 'Sửa thành công');
    }

    public function getDelete($id)
    {
    	$loaitin = LoaiTin::find($id);
    	$loaitin -> delete();
    	return redirect('admin/loai-tin/list')->with('thongbao', 'Xóa thành công');
    }

    public function list()
    {
    	$loaitin = LoaiTin::all();
    	return view('admin.loaitin.list', ['loaitin' => $loaitin]);
    }
}
