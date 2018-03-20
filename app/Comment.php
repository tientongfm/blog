<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'content',
    ];

    protected $table = "Comment";
    
    // tao lien ket giua cac model
    public function news(){
    	//comment thuoc tin tuc nao do
    	return $this->belongsTo('App\News', 'id_news', 'id');
    }

    public function user(){
    	//1 comment do 1 user
    	return $this->belongsTo('App\User', 'id_user', 'id');
    }
}
