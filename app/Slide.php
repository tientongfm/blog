<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model{

	protected $fillable = [
		'name', 
		'image',
		'content',
		'link',
	];

    protected $table = "Slide";


}
