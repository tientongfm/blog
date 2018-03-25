<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{

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


    	/*if($file = $request->hasFile('image')) {
            
            $file = $request->file('image') ;           
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/upload/slide/' ;
            $file->move($destinationPath,$fileName);
            $slide->image = $fileName ;
        }*/
        $file = $request->file('image');
        $destination_path = public_path().'/upload/slide/' ;
        $filename = str_random(6).'_'.$file->getClientOriginalName();
        $file->move($destination_path, $filename);
        $slide->image = $filename;

    	$slide->save();
    	return redirect('admin/slide/list')->with('thongbao', 'Thêm thành công');

    }

    public function getEdit($id){
        $slide = Slide::find($id);
        return view('admin.slide.edit', compact('slide'));
    }

    public function postEdit(Request $request,$id){
        $this->validate($request,
            [
                'name'=>'required',
                'content'=>'required'
            ],
            [
                'name.required'=>'Bạn chưa nhập tên Slide',
                'name.required'=>'Bạn chưa nhập nội dung Slide'

            ]);
        $slide = Slide::find($id);
        $slide->name = $request->input('name');
        $slide->content = $request->input('content');
        $slide->link = $request->input('link');

          // if user choose a file, replace the old one //
        if( $request->hasFile('image') ){
            $file = $request->file('image');
            $destination_path = public_path().'/upload/slide/' ;
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $file->move($destination_path, $filename);
            $slide->image = $filename;
        }

        dd($slide);

        $slide->save();
        return redirect('admin/slide/list')->with('thongbao', 'Sửa thành công');

    }

    public function getDelete($id)
    {
        $slide = Slide::find($id);
        $slide->delete();

        return redirect('admin/slide/list')->with('thongbao', 'Bạn đã xóa thành công');
    }

}

