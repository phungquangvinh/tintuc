<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
use App\TinTuc;
use App\Comment;

class TinTucController extends Controller
{
    public function getAdd()
    {
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::all();
    	return view('admin.tintuc.add',['theloai' => $theloai,'loaitin' => $loaitin]);
    }
    public function postAdd(Request $request)
    {
    	$this->validate($request, [
    		'title' => 'required|min:20|max:100|unique:tintuc,TieuDe',
    		'tomtat' => 'required|min:30|max:150',
    		'noidung' => 'required|min:250',
    		'image' => 'required'
    	],
    	[
    		'title.required' => 'Chưa nhập tiêu đề!',
    		'title.unique' => 'Tiêu đề đã tồn tại!',
    		'title.min' => 'Tiêu đề phải trên 20 kí tự!',
    		'title.max' => 'Tiêu đề không được quá 100 kí tự!',
    		'tomtat.required' => 'Chưa tóm tắt bài viết!',
    		'tomtat.min' => 'Tóm tắt phải trên 30 kí tự!',
    		'tomtat.max' => 'Tóm tắt không được quá 150 kí tự!',
    		'noidung.required' => 'Nhập nội dung bài viết!',
    		'noidung.min' => 'Bài viết phải trên 250 kí tự!',
    		'image.required' => 'Chưa chèn hình ảnh!',
    	]);

    	$tintuc = new TinTuc;
    	$tintuc->TieuDe = $request->title;
    	$tintuc->TieuDeKhongDau = changeTitle($request->title);
    	$tintuc->idLoaiTin = $request->ChonLoaiTin;
    	$tintuc->TomTat = $request->tomtat;
    	$tintuc->NoiDung = $request->noidung;
    	$tintuc->NoiBat = $request->noibat;
    	$tintuc->SoLuotXem = 0;

    	if($request->hasFile('image')){
    		$file = $request->file('image');
    		$extends = $file->getClientOriginalExtension();

    		if ($extends != 'jpg' && $extends != 'png' && $extends != 'jpeg') {
    			return redirect()->back()->with('thongbao', 'Chỉ được nhập các file hình ảnh có đuôi JPG, PNG và JPEG!');
    		}

    		$name = $file->getClientOriginalName();
    		$image = str_random(5)."_".$name;
    		while (file_exists("upload/tintuc/".$image)) {
    			$image = str_random(5)."_".$name;
    		}
    		$file->move("upload/tintuc/",$image); 
    		$tintuc->Hinh = $image;
    	}

    	$tintuc->save();
    	return redirect()->back()->with('thongbao', 'Thêm thành công');
    }

    public function getEdit($id)
    {
    	$tintuc = TinTuc::find($id);
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::all();
    	return view('admin.tintuc.edit',['loaitin' => $loaitin, 'theloai'=>$theloai, 'tintuc' => $tintuc]);
    }
    public function postEdit(Request $request,$id)
    {
    	$tintuc = TinTuc::find($id);
    	$this->validate($request, [
    		'title' => 'required|min:20|max:100',
    		'tomtat' => 'required|min:30|max:150',
    		'noidung' => 'required|min:250',
    		'image' => 'required'
    	],
    	[
    		'title.required' => 'Chưa nhập tiêu đề!',
    		'title.min' => 'Tiêu đề phải trên 20 kí tự!',
    		'title.max' => 'Tiêu đề không được quá 100 kí tự!',
    		'tomtat.required' => 'Chưa tóm tắt bài viết!',
    		'tomtat.min' => 'Tóm tắt phải trên 30 kí tự!',
    		'tomtat.max' => 'Tóm tắt không được quá 150 kí tự!',
    		'noidung.required' => 'Nhập nội dung bài viết!',
    		'noidung.min' => 'Bài viết phải trên 250 kí tự!',
    		'image.required' => 'Chưa chèn hình ảnh!',
    	]);

    	$tintuc->TieuDe = $request->title;
    	$tintuc->TieuDeKhongDau = changeTitle($request->title);
    	$tintuc->idLoaiTin = $request->ChonLoaiTin;
    	$tintuc->TomTat = $request->tomtat;
    	$tintuc->NoiDung = $request->noidung;
    	$tintuc->NoiBat = $request->noibat;

    	if($request->hasFile('image')){
    		$file = $request->file('image');
    		$extends = $file->getClientOriginalExtension();

    		if ($extends != 'jpg' && $extends != 'png' && $extends != 'jpeg') {
    			return redirect()->back()->with('thongbao', 'Chỉ được nhập các file hình ảnh có đuôi JPG, PNG và JPEG!');
    		}

    		$name = $file->getClientOriginalName();
    		$image = str_random(5)."_".$name;
    		while (file_exists("upload/tintuc/".$image)) {
    			$image = str_random(5)."_".$name;
    		}
    		unlink("upload/tintuc/".$tintuc->Hinh);
    		$file->move("upload/tintuc/",$image); 
    		$tintuc->Hinh = $image;
    	}

    	$tintuc->save();
    	return redirect()->back()->with('thongbao', 'Sửa tin thành công');
    }

    public function getDelete($id)
    {
    	$tintuc = TinTuc::find($id);
    	$tintuc -> delete();
    	return redirect('admin/tin-tuc/list')->with('thongbao', 'Xóa thành công');
    }

    public function list()
    {
    	$tintuc = TinTuc::orderBy('id','DESC')->get();
    	return view('admin.tintuc.list', ['tintuc' => $tintuc]);
    }
}
