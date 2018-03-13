<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
  	protected $table = "Category";

  	// tao lien ket giua cac model
    public function typenews()
    {
    	return $this->hasMany('App\Typenews','id_category', 'id');
    }

    public function news()
    {
    	return $this->hasManyThrough('App\News', 'App\Typenews', 'id_category', 'id_type_news', 'id');
    }
}
