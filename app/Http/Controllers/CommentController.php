<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use App\TinTuc;

class CommentController extends Controller
{
    public function getDelete($id,$idTinTuc)
    {
    	$comment = Comment::find($id);
    	$comment -> delete();
    	return redirect()->back()->with('thongbao', 'Xóa comment thành công');
    }

    public function postComment($id, Request $request){
    	$idTinTuc = $id;
    	$tintuc = TinTuc::find($id);
    	$comment = new Comment;
    	$comment->idTinTuc = $idTinTuc;
    	$comment->idUser = Auth::user()->id;
    	$comment->NoiDung = $request->NoiDung;
    	$comment->save();
    	return redirect()->back()->with('thongbao', 'Gửi comment thành công');
    }
}
