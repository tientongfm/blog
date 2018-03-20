<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Upload;

class UploadController extends Controller
{
    public function index(){
    	return view('uploadfile.index');
    }

    public function Upload_file(){
    	
    }
}
