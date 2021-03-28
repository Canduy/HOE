<?php

namespace App\Http\Controllers;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
     public function getlist(){
    	$user = User::all();
    	return view('admin.user.list',['user'=>$user]);
    }
    public function getadd(){
    	return view('admin.user.add');
    }

    public function postadd(Request $request){
    	$this->validate($request,
    	[
    		'name'=>'required|min:6',
    		'email'=>'required|email|unique:users,email',
    		'password'=>'required|min:6|max:32',
    		'passwordAgain'=>'required|same:password|min:6|max:32',
    	],

    	[	
    		'name.required'=>'Bạn chưa nhập tên người dùng',
    		'name.min'=>'Tên người dùng phải có ít nhất 6 kí tự',
    		'email.required'=>'Bạn chưa nhập email',
    		'email.email'=>'Bạn chưa nhập đúng định dạng email',
    		'email.unique'=>'Email đã tồn tại',
    		'password.required'=>'Bạn chưa nhập mật khẩu',
    		'password.min'=>'Mật khẩu phải có ít nhất 6 kí tự',
    		'password.max'=>'Mật khẩu chỉ được tối đa 32 kí tự',
    		'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu',
    		'passwordAgain.same'=>'Mật khẩu nhập lại chưa chính xác',
    	]);
    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	$user->quyen = $request->quyen;
    	$user->save();

    	return redirect('admin/user/add')->with('thongbao','Bạn đã thêm thành công');


    }
    public function getedit($id){
    	$user = User::find($id);

    	return view('admin.user.edit',['user'=>$user]);
    }

    public function postedit(Request $request,$id){
    	$this->validate($request,
    	[
    		'name'=>'required|min:6',
    	],

    	[	
    		'name.required'=>'Bạn chưa nhập tên người dùng',
    		'name.min'=>'Tên người dùng phải có ít nhất 6 kí tự',
    	]);
    	$user = User::find($id);
    	$user->name = $request->name;
    	$user->quyen = $request->quyen;
    	if($request->changePassword == "on"){
    		$this->validate($request,
    	[
    		'password'=>'required|min:6|max:32',
    		'passwordAgain'=>'required|same:password|min:6|max:32',
    	],

    	[	
    		'password.required'=>'Bạn chưa nhập mật khẩu',
    		'password.min'=>'Mật khẩu phải có ít nhất 6 kí tự',
    		'password.max'=>'Mật khẩu chỉ được tối đa 32 kí tự',
    		'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu',
    		'passwordAgain.same'=>'Mật khẩu nhập lại chưa chính xác',
    	]);
    		$user->password = bcrypt($request->password);
    	}

    	$user->save();

    	return redirect('admin/user/edit/'.$id)->with('thongbao','Sửa thành công');

    }
    public function postdelete($id){
    	$user = User::find($id);
      $comment = Comment::where('idUser',$id); //Tìm các comment của user
      $comment->delete(); //Xóa các comment của user
      $user->delete(); //Xóa user
    	return redirect("admin/user/list")->with('thongbao','Xóa thành công');
    }
    public function getloginAdmin(){
    	return view('admin.login');
    }
    public function postloginAdmin(Request $request){
    	$this->validate($request,
    		[
    			'email'=>'required',
    			'password'=>'required|min:6|max:32'
    		],

    		[
    			'email.required'=>'Bạn chưa nhập email',
    			'password.required'=>'Bạn chưa nhập password',
    			'password.min'=>'password phải có ít nhất 6 kí tự',
    			'password.max'=>'password  có tối đa 32 kí tự',
    		]);
    	if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
    			return redirect('admin/loaitin/list');
    	}else{
    		return redirect('admin/login')->with('thongbao','Đăng nhập thất bại');
    	}
    }
    public function getlogoutAdmin(){
    	Auth::logout();
    	return redirect('admin/login');
    }
}
