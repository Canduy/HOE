<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Loaitin;
// use App\TheLoai;
//  use App\Tintuc;
 use App\Comment;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;


class commentController extends Controller
{
      public function getdelete($id,$idTinTuc){
    	$comment = Comment::find($id);
    	$comment->delete();

    	return redirect('admin/tintuc/edit/'.$idTinTuc)->with('thongbao','xóa comment thành công');
    }
}
