<?php

namespace App\Http\Controllers;
 use App\TheLoai;
 use App\Loaitin;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getLoaitin($idTheLoai){
    	$loaitin = Loaitin::where('idTheLoai',$idTheLoai)->get();
    	foreach($loaitin as $lt){
    		echo "<option value='".$lt->id."'>".$lt->Ten."</option>";
    	}
    }
}
