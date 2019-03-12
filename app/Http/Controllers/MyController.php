<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\TheLoai;
use App\User;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;

class MyController extends Controller
{
    function __construct()
    {
        $theloai = TheLoai::all();
        $slide = Slide::all();
        view()->share('theloai',$theloai);
        view()->share('slide', $slide);
    }

    public function index()
    {        
        return view('index');
    }
    
    public function admin()
    {
    	return view('admin.index');
    }

    public function contact()
    {        
        return view('contact');
    }

    public function category($id)
    {   
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);     
        return view('loaitin', ['loaitin'=>$loaitin, 'tintuc'=>$tintuc]);
    }

    public function tintuc($id)
    {   
        $tintuc = TinTuc::find($id);   
        $noibat = TinTuc::where('NoiBat',1)->take(4)->get();
        $lienquan = TinTuc::where('idLoaiTin', $tintuc->idLoaiTin)->take(4)->get();  
        return view('tintuc', ['tintuc'=>$tintuc, 'noibat' => $noibat, 'lienquan' => $lienquan]);
    }

    public function search(Request $request)
    {
        $key = $request->get('key');
        $tintuc = TinTuc::where('TieuDe','like','%'.$key.'%')->orWhere('TomTat','like','%'.$key.'%')->orWhere('NoiDung','like','%'.$key.'%')->paginate(10);
        return view('search',['tintuc'=>$tintuc, 'key'=>$key]);
    }
}
