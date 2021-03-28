<?php

namespace App\Http\Controllers;
use App\slide;
use Illuminate\Http\Request;

class slideController extends Controller
{
     public function getlist(){
    	$slide = slide::all();
    	return view('admin.slide.list',['slide'=>$slide]);
    }
    public function getadd(){
    	return view('admin.slide.add');
    }

    public function postadd(Request $request){
    	$this->validate($request,
    		[
    			'Ten' => 'required',
    			'NoiDung' => 'required'
    		],

    		[
    			'Ten.required'=>'Bạn chưa nhập tên',
    			'NoiDung.required'=>'Bạn chưa nhập nội dung',
    		]);
    	$slide = new slide;
    	$slide->Ten = $request->Ten;
    	$slide->NoiDung = $request->NoiDung;
    	if($request->has('link'))
    		$slide->link = $request->link;

    	if($request->hasFile('Hinh')){
    		$file = $request->file('Hinh');
    		$duoi = $file->getClientOriginalExtension();
    		if($duoi != 'jpg' &&  $duoi != 'png' && $duoi != 'jpeg'){
    			return redirect("admin/slide/add")->with('loi','Bạn chỉ được chọn file có đuôi jpg,png,jpeg');
    		}
    		$name = $file->getClientOriginalName();
    		$Hinh = str_random(4)."-". $name;
    		while(file_exists("upload/slide/".$Hinh)){
    			$Hinh = str_random(4)."-". $name;
    		}
    		$file->move("upload/slide",$Hinh);
    		$slide->Hinh = $Hinh;
    	}else{
    		$slide->Hinh="";
    	}
    	$slide->save();

    	return  redirect('admin/slide/add')->with('thongbao','Thêm thành công');
    }
    public function getedit($id){
    	$slide = slide::find($id);

    	return view('admin.slide.edit',['slide'=>$slide]);

    }

    public function postedit(Request $request,$id){
    	$this->validate($request,
    		[
    			'Ten' => 'required',
    			'NoiDung' => 'required'
    		],

    		[
    			'Ten.required'=>'Bạn chưa nhập tên',
    			'NoiDung.required'=>'Bạn chưa nhập nội dung',
    		]);
    	$slide =  slide::find($id);
    	$slide->Ten = $request->Ten;
    	$slide->NoiDung = $request->NoiDung;
    	if($request->has('link'))
    		$slide->link = $request->link;

    	if($request->hasFile('Hinh')){
    		$file = $request->file('Hinh');
    		$duoi = $file->getClientOriginalExtension();
    		if($duoi != 'jpg' &&  $duoi != 'png' && $duoi != 'jpeg'){
    			return redirect("admin/slide/add")->with('loi','Bạn chỉ được chọn file có đuôi jpg,png,jpeg');
    		}
    		$name = $file->getClientOriginalName();
    		$Hinh = str_random(4)."-". $name;
    		while(file_exists("upload/slide/".$Hinh)){
    			$Hinh = str_random(4)."-". $name;
    		}
    		$file->move("upload/slide",$Hinh);
    		unlink("upload/slide/".$slide->Hinh);
    		$slide->Hinh = $Hinh;
    	}
    	$slide->save();

    	return  redirect('admin/slide/edit/'.$id)->with('thongbao','Sửa thành công');
    }
    public function postdelete($id){
    	$slide = slide::find($id);
    	$slide->delete();

    	return redirect('admin/slide/list')->with('thongbao','xóa thành công');
    }
}
