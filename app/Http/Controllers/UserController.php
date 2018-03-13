<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    //
    public function getList()
    {
    	$user = User::all();
    	return view('admin.user.list',['user'=>$user]);

    }

    public function getAdd()
    {
    	$user = User::all();
    	return view('admin.user.add');
    	
    }

    public function postAdd(Request $request)
    {
        $this->validate($request,[
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:3|max:32',
                'passwordAgain' => 'required|same:password'
            ],[
                'name.required' => 'Bạn chưa nhập tên người dùng',
                'name.min' => 'Tên người dùng phải có ít nhất 3 ký tự',

                'email.required' => 'Bạn chưa nhập địa chỉ email',
                'email.email' => 'Bạn chưa nhập đúng tên định dạng email',
                'email.unique' => 'Email này đã tồn tại',

                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu phải có ít nhât 3 ký tự',
                'password.max' => 'Mật khẩu quá dài, mật khẩu nhỏ hơn 32 ký tự',
                'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp',
            ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt ($request->password);
        $user->level = $request->level;
        $user->save();

        return redirect('admin/user/list')->with('thongbao','Thêm user thành công');

    }

    public function getEdit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit',['user'=>$user]);
    }

    public function postEdit(Request $request, $id)
    {
        $this->validate($request,[
                'name' => 'required|min:3',
                
            ],[
                'name.required' => 'Bạn chưa nhập tên người dùng',
                'name.min' => 'Tên người dùng phải có ít nhất 3 ký tự',

            ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->level = $request->level;

        if($request->changePassword == "on")
        {
            $this->validate($request,[
                'password' => 'required|min:3|max:32',
                'passwordAgain' => 'required|same:password'
            ],[
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu phải có ít nhât 3 ký tự',
                'password.max' => 'Mật khẩu quá dài, mật khẩu nhỏ hơn 32 ký tự',
                'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp',
            ]);
            $user->password = bcrypt ($request->password);
        }
     

        $user->save();
        return redirect('admin/user/edit/' .$id)->with('thongbao', 'Bạn đã sửa thành công');
    }

    public function getDelete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('admin/user/list')->with('thongbao', 'Đã xóa người dùng thành công');
        
    }


    public function getLoginAdmin()
    {
        return view('admin.login');
    }

    public function postLoginAdmin(Request $request)
    {
        $this->validate($request,[
            'email'=>'required',
            'password' => 'required|min:3|max:32',
            ],[
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhât 3 ký tự',
            'password.max' => 'Mật khẩu quá dài, mật khẩu nhỏ hơn 32 ký tự',
            ]);

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect('admin/category/list')->with('thongbao', 'Đăng nhập thành công');
        }
        else
        {
            return redirect('admin/login')->with('thongbao', 'Đăng nhập không thành công');
        }
    }

    public function getLogoutAdmin()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}