<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\TheLoai;
Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login','UserController@getloginAdmin');
Route::post('admin/login','UserController@postloginAdmin');
Route::get('admin/logout','UserController@getlogoutAdmin');


Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
	// admin/theloai/list
	Route::group(['prefix'=>'theloai'],function(){
			Route::get('list','TheLoaiController@getlist');
			Route::get('edit/{id}','TheLoaiController@getedit');
			Route::post('edit/{id}','TheLoaiController@postedit');
			Route::get('add','TheLoaiController@getadd');
			Route::post('add','TheLoaiController@postadd');
			Route::get('delete/{id}','TheLoaiController@postdelete');
	});
	Route::group(['prefix'=>'loaitin'],
	// admin/loaitin/list
		function(){
			Route::get('list','LoaitinController@getlist');
			Route::get('edit/{id}','LoaitinController@getedit');
			Route::post('edit/{id}','LoaitinController@postedit');
			Route::get('add','LoaitinController@getadd');
			Route::post('add','LoaitinController@postadd');
			Route::get('delete/{id}','LoaitinController@postdelete');
		
	});
	Route::group(['prefix'=>'tintuc'],
	// admin/loaitin/list
		function(){
			Route::get('list','tintucController@getlist');
			Route::get('edit/{id}','tintucController@getedit');
			Route::post('edit/{id}','tintucController@postedit');
			Route::get('add','tintucController@getadd');
			Route::post('add','tintucController@postadd');
			Route::get('delete/{id}','tintucController@postdelete');
	});
	Route::group(['prefix'=>'comment'],function(){
		Route::get('delete/{id}/{idTinTuc}','commentController@getdelete');
	});
	Route::group(['prefix'=>'slide'],
	// admin/loaitin/list
		function(){
			Route::get('list','slideController@getlist');
			Route::get('edit/{id}','slideController@getedit');
			Route::post('edit/{id}','slideController@postedit');
			Route::get('add','slideController@getadd');
			Route::post('add','slideController@postadd');
			Route::get('delete/{id}','slideController@postdelete');
	});
	Route::group(['prefix'=>'user'],
	// admin/loaitin/list
		function(){
			Route::get('list','UserController@getlist');
			Route::get('edit/{id}','UserController@getedit');
			Route::post('edit/{id}','UserController@postedit');
			Route::get('add','UserController@getadd');
			Route::post('add','UserController@postadd');
			Route::get('delete/{id}','UserController@postdelete');
	});
	Route::group(['prefix'=>'ajax'],function(){
		Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
	});
});
// Route::get('test',function(){
// 	return view('admin.theloai.list');
// });
Route::get('trang-chu','PageController@home');
Route::get('lien-he','PageController@contact');
Route::get('loaitin/{id}/{TenKhongDau}.html','PageController@loaitin');
Route::get('tintuc/{id}/{TieuDeKhongDau}.html','PageController@tintuc');


Route::match(['get', 'post'], 'timkiem','PageController@timkiem'); 