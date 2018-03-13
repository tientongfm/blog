<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//su dung model category
use App\Category;
//su dung model typenews
use App\Typenews;

class TypenewsController extends Controller
{
    //
    public function getList()
    {
        $typenews = Typenews::all();
        return view('admin.typenews.list', ['typenews'=>$typenews]);

    }

    public function getAdd()
    {
    	$category = Category::all();
        return view('admin.typenews.add',['category'=>$category]);
    	
    }

    public function postAdd(Request $request)
    {
    	$this->validate($request, 
    		[
    			'name' => 'required|unique:category,name|min:3|max:100',
    			'Category' => 'required'

    		],
    		[
    			'name.required' => 'Bạn chưa nhập tên loại tin',
                'name.unique' => 'Tên loại tin này đã tồn tại',
                'name.min' => 'Tên loại tin có độ dài từ 3 đến 100 ký tự',
                'name.max' => 'Tên loại tin có độ dài từ 3 đến 100 ký tự',
                'Category.required' => 'Bạn chưa chọn thể loại'
    		]
    		);
        //luu vao model loai tin

        /*echo json_encode($request->all());
        die();*/
        $typenews = new Typenews;
        $typenews->name = $request->name;
        $typenews->name_without_accent = changeTitle($request->name);
        $typenews->id_category = $request->Category;
        $typenews->save();

        return $typenews;
        die();
        return redirect('admin/typenews/list')->with('thongbao',' Bạn đã thêm loại tin thành công');
    }

    public function getEdit($id)
    {
        $category = Category::all();
        $typenews = Typenews::find($id);
        return view('admin.typenews.edit',['typenews'=>$typenews],['category'=>$category]);	
    }

    public function postEdit(Request $request, $id)
    {
        $this->validate($request, 
            [
                'name' => 'required|unique:category,name|min:3|max:100',
                'Category' => 'required'

            ],
            [
                'name.required' => 'Bạn chưa nhập tên loại tin',
                'name.unique' => 'Tên loại tin này đã tồn tại',
                'name.min' => 'Tên loại tin có độ dài từ 3 đến 100 ký tự',
                'name.max' => 'Tên loại tin có độ dài từ 3 đến 100 ký tự',
                'Category.required' => 'Bạn chưa chọn thể loại'

            ]
            );

        //sua ten loai tin
        $typenews = Typenews::find($id);
        $typenews->name = $request->name;
        $typenews->name_without_accent = changeTitle($request->name);
        $typenews->id_category = $request->Category;
        $typenews->save(); 

        return redirect('admin/typenews/edit/' .$id)->with('thongbao' , 'Sửa thành công');
       
    }

    public function getDelete($id)
    {
        $typenews = Typenews::find($id);
        $typenews->delete();

        return redirect('admin/typenews/list')->with('thongbao', 'Bạn đã xóa loại tin thành công');
        
    }
}
