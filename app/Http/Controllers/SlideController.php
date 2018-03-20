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


        $slide= new Slide($request->input()) ;
        /*$slide = new Slide;*/
    	$slide->name = $request->name;
    	$slide->content = $request->content;
        $slide->link = $request->link;


    	if($file = $request->hasFile('image')) {
            
            $file = $request->file('image') ;           
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/upload/slide/' ;
            $file->move($destinationPath,$fileName);
            $slide->image = $fileName ;
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
    	return redirect('admin/slide/list')->with('thongbao', 'Thêm thành công');

    }

    public function getDelete($id)
    {
        $slide = Slide::find($id);
        $slide->delete();

        return redirect('admin/slide/list')->with('thongbao', 'Bạn đã xóa thành công');
    }

}
