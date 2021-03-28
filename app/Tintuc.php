<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tintuc extends Model
{
    protected $table = "TinTuc";

    public function loaitin(){
    	return $this->belongsTo('App\Loaitin','idLoaiTin','id');
    }

    public function comment(){
    	return $this->hasMany('App\Comment','idTinTuc','id');
    }
}
