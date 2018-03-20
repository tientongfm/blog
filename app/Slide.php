<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model{

	protected $fillable = [
		'name', 
		'content',
		'link',
		'image',
	];

    protected $table = "Slide";


}
