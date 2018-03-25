<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class UploadController extends Controller
{
    /* 1. This method relates to the "images list" view */
	public function index()
	{
	    $slide = Slide::paginate(10);
	    return view('admin.slide.list')->with('slide', $slide);
	}

	/* 2. This method relates to the "add new image" view */
	public function create()
	{
	    return view('admin.slide.add');
	}

	public function store(Request $request)
    {
	  

	      $slide = new Slide;

	      // upload the image //
	      $file = $request->file('image');
	      $destination_path = public_path().'/upload/slide/' ;
	      $filename = str_random(6).'_'.$file->getClientOriginalName();
	      $file->move($destination_path, $filename);
	      
	      // save image data into database //
	      $slide->image = $filename;
	      $slide->name = $request->input('name');
	      $slide->content = $request->input('content');
	      $slide->link = $request->input('link');
	      $image->save();

	      return redirect('admin/slide/list')->with('thongbao', 'Thêm thành công');
	    }

	/* 3. This method relates to the "image detail" view */
	public function show($id)
	{
	   /* $image = Image::find($id);
	    return view('images.image-detail')->with('image', $image);*/
	}

	/* 4. This method relates to the "edit image" view */
	public function edit($id)
	{
		$slide = Slide::find($id);
		return view('admin.slide.edit')->with('image', $image);
	}

	public function update(Request $request, $id)
    {

	      // Process valid data & go to success page //
	    $slide = Slide::find($id);

	      // if user choose a file, replace the old one //
	    if( $request->hasFile('image') ){
	        $file = $request->file('image');
	        $destination_path = 'uploads/';
	        $filename = str_random(6).'_'.$file->getClientOriginalName();
	        $file->move($destination_path, $filename);
	        $image->file = $destination_path . $filename;
	    }
	        
	    // replace old data with new data from the submitted form //
	    $image->caption = $request->input('caption');
	    $image->description = $request->input('description');
	    $image->save();
/*
	    dd($image);
	    die();*/

	    return redirect('/')->with('message','You just updated an image!');
    }

	public function destroy($id)
    {
	    $image = Image::find($id);
	    $image->delete();
	    return redirect('/')->with('message','You just uploaded an image!');
    }
}

