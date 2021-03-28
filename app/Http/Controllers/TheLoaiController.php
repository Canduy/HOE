<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class TheLoaiController extends Controller
{
    public function getlist(){
    	$theloai = TheLoai::all();
    	return view('admin.theloai.list',['theloai'=>$theloai]);
    }
    public function getadd(){
    	return view('admin.theloai.add');
    }

    public function postadd(Request $request){
    	// echo $request->Ten;
    	$this->validate($request,
    	[
 			'Ten' => 'required|min:3|max:100|unique:TheLoai,Ten' 
    	],
   
    	[
    		'Ten.required'=>'Bạn chưa nhập tên thể loại',
    		'Ten.min'=>'Tên thể loại phải có độ dài 3-100 kí tự',
    		'Ten.max'=>'Tên thể loại phải có độ dài 3-100 kí tự',
    		'Ten.unique'=>'Tên thể loại đã tồn tại',
    	]);
    	$theloai = new TheLoai;
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	$theloai->save();

    	return redirect('admin/theloai/add')->with('thongbao','Thêm thành công');
    }
    public function getedit($id){
    	$theloai = TheLoai::find($id);
    	return view('admin.theloai.edit',['theloai'=>$theloai]); 
    }

    public function postedit(Request $request,$id){
    	$theloai = TheLoai::find($id);
    	$this->validate($request,
	    	[
	    		'Ten' => 'required|unique:TheLoai,Ten|min:3|max:100'
	    	],

	    	[
	    		'Ten.required' =>'Bạn chưa nhập tên thể loại',
	    		'Ten.unique'=>'Tên thể loại đã tồn tại',
	    		'Ten.min'=>'Tên thể loại phải có độ dài 3-100 kí tự',
	    		'Ten.max'=>'Tên thể loại phải có độ dài 3-100 kí tự',
	    	]);
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	$theloai->save();

    	return redirect('admin/theloai/edit/'.$id)->with('thongbao','sửa thành công');

    }
    public function postdelete($id){
    	$theloai = TheLoai::find($id);
   		$theloai->delete();

   		return redirect('admin/theloai/list')->with('thongbao','Xóa thành công');
    }
}
