<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loaitin extends Model
{
    protected $table = "LoaiTin";
    
    public function theloai(){
    	return $this->belongsTo('App\TheLoai','idTheLoai','id');
    }

    public function tintuc(){
    	return $this->hasMany('App\Tintuc','idLoaiTin','id');
    }
}
