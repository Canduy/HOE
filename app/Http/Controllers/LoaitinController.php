<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Loaitin;
use App\TheLoai;
 use App\Tintuc;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class LoaitinController extends Controller
{
    public function getlist(){
    	$loaitin = Loaitin::all();
    	return view('admin.loaitin.list',['loaitin'=>$loaitin]);
    }
    public function getadd(){
    	$theloai = TheLoai::all();
    	return view('admin.loaitin.add',['theloai'=>$theloai]);
    }

    public function postadd(Request $request){
    	$this->validate($request,
    		[
    			'Ten' =>'required|unique:Loaitin,Ten,|min:1|max:100',
    			'TheLoai'=>'required'
    		],

    		[
    			'Ten.required'=>'Bạn chưa nhập tên loại tin',
    			'Ten.unique'=>'Tên loại tin đã tồn tại',
    			'Ten.min'=>'Tên loại tin phải có độ dài từ 1 đến 100 kí tự',
    			'Ten.max'=>'Tên loại tin phải có độ dài từ 1 đến 100 kí tự',
    			'TheLoai.required'=>'Bbạn chưa chọn thể loại',
    		]);
    	$loaitin = new Loaitin;
    	$loaitin->Ten = $request->Ten;
    	$loaitin->TenKhongDau = changeTitle($request->Ten);
    	$loaitin->idTheLoai = $request->TheLoai;
    	$loaitin->save();

    	return redirect('admin/loaitin/add')->with('thongbao','Bạn đã thêm thành công');
    }
    public function getedit($id){
    	$theloai = TheLoai::all();
    	$loaitin = Loaitin::find($id);

    	return view('admin.loaitin.edit',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }

    public function postedit(Request $request,$id){
    	$this->validate($request,
    		[
    			'Ten' =>'required|unique:Loaitin,Ten,|min:1|max:100',
    			'TheLoai'=>'required'
    		],

    		[
    			'Ten.required'=>'Bạn chưa nhập tên loại tin',
    			'Ten.unique'=>'Tên loại tin đã tồn tại',
    			'Ten.min'=>'Tên loại tin phải có độ dài từ 1 đến 100 kí tự',
    			'Ten.max'=>'Tên loại tin phải có độ dài từ 1 đến 100 kí tự',
    			'TheLoai.required'=>'Bbạn chưa chọn thể loại',
    		]);
    $loaitin = Loaitin::find($id);
    $loaitin->Ten = $request->Ten;
    $loaitin->TenKhongDau = changeTitle($request->Ten);
    $loaitin->idTheLoai = $request->TheLoai;
    $loaitin->save();

    return redirect('admin/loaitin/edit/'.$id)->with('thongbao','Bạn đã sửa thành công');

    }
    public function postdelete($id){
    	$loaitin = Loaitin::find($id);
        $tintuc = Tintuc::where('idloaitin',$id);
        $tintuc->delete();
    	$loaitin->delete();
    	return redirect('admin/loaitin/list')->with('thongbao','Xóa thành công');
    }
}
