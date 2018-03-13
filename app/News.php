<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    protected $table = "News";
    
    // tao lien ket giua cac model
    public function typenews(){
    	//1 tin tuc thuoc 1 loai tin
    	return $this->belongsTo('App\Typenews', 'id_type_news', 'id');
    }

    public function comment(){
    	//1 tin tuc co nhieu comment
    	return $this->hasMany('App\Comment', 'id_news', 'id');
    }
}
