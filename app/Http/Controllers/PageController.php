<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\slide;
use App\Loaitin;
use App\Tintuc;
class PageController extends Controller
{

	function __construct(){
    	$theloai = TheLoai::all();
    	$slide = slide::all();
    	view()->share('theloai',$theloai);
    	view()->share('slide',$slide);
	}
    function home(){
    	return view('page.Home');
    }

    function contact(){
    	return view('page.contact');
    }
    function loaitin($id){
        $loaitin = Loaitin::find($id);
        $tintuc = Tintuc::where('idLoaiTin',$id)->paginate(5);
        return view('page.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }
    function tintuc($id){
        $tintuc = Tintuc::find($id);
        $tinnoibat = Tintuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan = Tintuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        // DB::table('tintuc')->where('id', $id)->update(['SoLuotXem' => $tintuc->SoLuotXem+1]);
        return view('page.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }

    function timkiem(Request $request){
        $tukhoa = $request->tukhoa;
        $tintuc = Tintuc::where('TieuDe','like',"%$tukhoa%")->orwhere('TomTat','like',"%$tukhoa%")->orwhere('NoiDung','like',"%$tukhoa%")->take(10)->paginate(5);
        return view('page.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
    }
}
