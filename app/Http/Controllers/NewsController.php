<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//su dung model category
use App\Category;
//su dung model typenews
use App\Typenews;
//su dung model news
use App\News;

class NewsController extends Controller
{

    public function getList()
    {
    	$news = News::orderBy( 'id', 'DESC')->get();
    	return view('admin.news.list', ['news'=>$news]);
    }

    public function getAdd()
    {
    	$category = Category::all();
    	$typenews = Typenews::all();
    	return view('admin.news.add', ['category'=>$category], ['typenews'=>$typenews]);
    }

    public function postAdd(Request $request)
    {
    	$this->validate($request, 
    		[
    			'title' => 'required|unique:news,title|min:3|max:255',
    			'summary' => 'required',
    			'content' => 'required',

    		],
    		[
    			'title.required' => 'Bạn chưa nhập tiêu đề',
    			'title.unique' => 'Tiêu đề đã tồn tại',
    			'title.min' => 'Tiêu đề quá ngắn',
    			'title.max' => 'Tiêu đề quá dài',
    			'summary.required' => 'Bạn chưa nhập tóm tắt tin',
    			'content.required' => 'Bạn chưa nội dung tin',
    		]
    	);

    	$news = new News;
        $news->title = $request->title;
        $news->name_without_accent = changeTitle($request->title);
        $news->id_type_news = $request->typenews;
        $news->hotnews = $request->hotnews;
        $news->summary = $request->summary;                    
        $news->content = $request->content;
        $news->view_counts = 0;

        // upload the image //
        $file = $request->file('image');
        $destination_path = public_path().'/upload/tintuc/' ;
        $filename = str_random(6).'_'.$file->getClientOriginalName();
        $file->move($destination_path, $filename);
          
        // save image data into database //
        $news->image = $filename;
        $news->save();
        return redirect('admin/news/add')->with('thongbao', 'Thêm tin thành công');
    }

    public function getEdit($id){
        $category = Category::all();
        $typenews = Typenews::all();
        $news = News::find($id);
        return view('admin.news.edit', compact('category', 'typenews', 'news'));
           /* ['news'=>$news, 'category'=>$category, 'typenews'=>$typenews]);*/

    }

    public function postEdit(Request $request,$id)
    {
        $this->validate($request, 
            [
                'title' => 'required|min:3|max:255',
                'summary' => 'required',
                'content' => 'required',

            ],
            [
                'title.required' => 'Bạn chưa nhập tiêu đề',
  
                'title.min' => 'Tiêu đề quá ngắn',
                'title.max' => 'Tiêu đề quá dài',
                'summary.required' => 'Bạn chưa nhập tóm tắt tin',
                'content.required' => 'Bạn chưa nội dung tin',
            ]
        );

        $news = News::find($id);

        $news->title = $request->title;
        $news->name_without_accent = changeTitle($request->title);
        $news->id_type_news = $request->typenews =1;
        $news->hotnews = $request->hotnews;
        $news->summary = $request->summary;                    
        $news->content = $request->content;
        $news->view_counts = 0;


        /*if($file = $request->hasFile('image')) {
            
            $file = $request->file('image') ;
            
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/upload/tintuc/' ;
            $file->move($destinationPath,$fileName);
            $news->image = $fileName;
        }*/
        if( $request->hasFile('image1') ){
            $file = $request->file('image1');
            $destination_path = public_path().'/upload/tintuc/' ;
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $file->move($destination_path, $filename);
            $news->image = $filename;
        }

        $news->save();
        return redirect('admin/news/list')->with('thongbao', 'Sửa thành công');

    }

    public function getDelete($id)
    {
        $news = News::find($id);
        $news->delete();

        return redirect('admin/news/list')->with('thongbao', 'Bạn đã xóa thành công');
    }

}
