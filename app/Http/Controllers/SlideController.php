<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
    //
    public function getList()
    {
    	$slide = Slide::all();
    	return view('admin.slide.list', ['slide'=>$slide]);
    }

    public function getAdd()
    {
    	return view('admin.slide.add');
    }

    public function postAdd(Request $request){

       /* return json_encode($request);
        die();
*/
    	$this->validate($request,
    		[
    			'name'=>'required',
    			'content'=>'required'
    		],
    		[
    			'name.required'=>'Bạn chưa nhập tên Slide',
    			'name.required'=>'Bạn chưa nhập nội dung Slide'

    		]);

    	$slide = new Slide;
    	$slide->name = $request->name;
    	$slide->content = $request->content;
        $slide->link = $request->link;

    	/*if($request->has('link'))
    		$slide->link = $request->link;*/

    	if($request->hasFile('image'))
    	{
    		$file = $request->file('image');
    		$below = $file->getClientOriginalExtension();
    		if($below != 'jpg' && $below != 'png' &&$bellow != 'jpeg')
    		{
    			return redirect('admin/slide/add')->with('loi', 'Bạn chỉ được chọn các file có đuôi jpg, png, jpeg');
    		}
    		$name = $file->getClientOriginalName();
    		$image = str_random(4)."_".$name;
    		while(file_exists("upload/slide/".$image))
    		{
    			$image = str_random(4)."_".$name;
    		}
    		$file->move("upload/slide", $image);
    		$slide->image = $image;
    	}
    	
    	else
    	{
    		$slide->image = "";
    	}

      /*  $slide= new Slide($request->input()) ;
     
         if($file = $request->hasFile('image')) {
            
            $file = $request->file('image') ;
            
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/image/slide/' ;
            $file->move($destinationPath,$fileName);
            $slide->image = $fileName ;
        }
*/
    	$slide->save();
    	return redirect('admin/slide/add')->with('thongbao', 'Thêm thành công');

    }

}
