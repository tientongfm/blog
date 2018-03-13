<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//su dung model category
use App\Category;

class CategoryController extends Controller
{
    //
    public function getList()
    {
        $category = Category::all();
        return view('admin.category.list', ['category'=>$category]);

    }

    public function getAdd()
    {
        return view('admin.category.add');
    	
    }

    public function postAdd(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|unique:typenews,name|min:3|max:100'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên loại tin',
                'name.unique' => 'Tên thể loại này đã tồn tại',
                'name.min' => 'Tên thể loại có độ dài từ 3 đến 100 ký tự',
                'name.max' => 'Tên thể loại có độ dài từ 3 đến 100 ký tự',

            ]);

        //luu vao model the loai
        $category = new Category;
        $category->name = $request->name;
        $category->name_without_accent = changeTitle($request->name);
        $category->save();


        return redirect('admin/category/list')->with('thongbao','Thêm thành công');
    }

    public function getEdit($id)
    {
    	$category = Category::find($id);
        return view('admin.category.edit',['category'=>$category]);
    }

    public function postEdit(Request $request, $id)
    {
        $category = Category::find($id);
        $this->validate($request,
            [
                'name' => 'required|unique:category,name|min:3|max:100'
            ],
            [
                'name.required' => 'Bạn chưa nhập tên thể loại',
                'name.unique' => 'Tên thể loại này đã tồn tại',
                'name.min' => 'Tên thể loại có độ dài từ 3 đến 100 ký tự',
                'name.max' => 'Tên thể loại có độ dài từ 3 đến 100 ký tự',
            ]
            );

        //sua ten the loai
        $category->name = $request->name;
        $category->name_without_accent = changeTitle($request->name);
        $category->save(); 

        return redirect('admin/category/edit/' .$id)->with('thongbao' , 'Sửa thành công'); 
    }

    public function getDelete($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect('admin/category/list')->with('thongbao', 'Bạn đã xóa thành công thể loại ' .$category->name);
    }
}
