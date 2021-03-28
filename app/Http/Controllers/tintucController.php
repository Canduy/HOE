<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Loaitin;
use App\TheLoai;
 use App\Tintuc;
 use App\Comment;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class tintucController extends Controller
{
    public function getlist(){
    	$tintuc = Tintuc::orderBy('id','DESC')->get();

    	return view('admin.tintuc.list',['tintuc'=>$tintuc]);
    }
    public function getadd(){
    	$theloai = TheLoai::all();
    	$loaitin = Loaitin::all();
    	return view('admin.tintuc.add',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    public function postadd(Request $request){
    	$this->validate($request,
    		[
    			'LoaiTin'=>'required',
    			'TieuDe'=>'required|min:3|unique:Tintuc,TieuDe',
    			'TomTat'=>'required',
    			'NoiDung'=>'required',
    		],
    		[	
    			'LoaiTin.required'=>'Bạn chưa chọn loại tin',
    			'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
    			'TieuDe.min'=>'Tiêu đề phải có ít nhất 3 kí tự',
    			'TomTat.required'=>'Bạn chưa nhập tóm tắt',
    			'NoiDung.required'=>'Bạn chưa nhập nội dung'
    		]);
    	$tintuc = new Tintuc;
    	$tintuc->TieuDe = $request->TieuDe;
    	$tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
    	$tintuc->idLoaiTin = $request->LoaiTin;
    	$tintuc->TomTat = $request->TomTat;
    	$tintuc->NoiDung = $request->NoiDung;
    	$tintuc->SoLuotXem = 0;
    	if($request->hasFile('Hinh')){
    		$file = $request->file('Hinh');
    		$duoi = $file->getClientOriginalExtension();
    		if($duoi != 'jpg' &&  $duoi != 'png' && $duoi != 'jpeg'){
    			return redirect("admin/tintuc/add")->with('loi','Bạn chỉ được chọn file có đuôi jpg,png,jpeg');
    		}
    		$name = $file->getClientOriginalName();
    		$Hinh = str_random(4)."-". $name;
    		while(file_exists("upload/tintuc/".$Hinh)){
    			$Hinh = str_random(4)."-". $name;
    		}
    		$file->move("upload/tintuc",$Hinh);
    		$tintuc->Hinh = $Hinh;
    	}else{
    		$tintuc->Hinh="";
    	}
    	$tintuc->save();

    	return redirect("admin/tintuc/add")->with('thongbao','Bạn đã thêm tin tức thành công');
    }
    public function getedit($id){
    	
    	$theloai = TheLoai::all();
    	$loaitin = Loaitin::all();
    	$tintuc = Tintuc::find($id);
    	return view('admin/tintuc/edit',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    public function postedit(Request $request,$id){
    	$tintuc = Tintuc::find($id);
    	$this->validate($request,
    		[
    			'LoaiTin'=>'required',
    			'TieuDe'=>'required|min:3|unique:Tintuc,TieuDe',
    			'TomTat'=>'required',
    			'NoiDung'=>'required',
    		],
    		[	
    			'LoaiTin.required'=>'Bạn chưa chọn loại tin',
    			'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
    			'TieuDe.min'=>'Tiêu đề phải có ít nhất 3 kí tự',
    			'TomTat.required'=>'Bạn chưa nhập tóm tắt',
    			'NoiDung.required'=>'Bạn chưa nhập nội dung'
    		]);
    	$tintuc->TieuDe = $request->TieuDe;
    	$tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
    	$tintuc->idLoaiTin = $request->LoaiTin;
    	$tintuc->TomTat = $request->TomTat;
    	$tintuc->NoiDung = $request->NoiDung;
    	if($request->hasFile('Hinh')){
    		$file = $request->file('Hinh');
    		$duoi = $file->getClientOriginalExtension();
    		if($duoi != 'jpg' &&  $duoi != 'png' && $duoi != 'jpeg'){
    			return redirect("admin/tintuc/add")->with('loi','Bạn chỉ được chọn file có đuôi jpg,png,jpeg');
    		}
    		$name = $file->getClientOriginalName();
    		$Hinh = str_random(4)."-". $name;
    		while(file_exists("upload/tintuc/".$Hinh)){
    			$Hinh = str_random(4)."-". $name;
    		}
    		$file->move("upload/tintuc",$Hinh);
    		unlink("upload/tintuc/".$tintuc->Hinh);
    		$tintuc->Hinh = $Hinh;
    	}
    	$tintuc->save();

    	return redirect('admin/tintuc/edit/'.$id)->with('thongbao','Bạn đã sửa thành công');
    }
    public function postdelete($id){
    	$tintuc = Tintuc::find($id);
    	$tintuc->delete();

    	return redirect('admin/tintuc/list')->with('thongbao','xóa thành công');
    }
}
