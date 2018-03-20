<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable = [
    	'avatar'
    ]

    protected $table = 'upload';
}
