<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function getRegister()
    {
        $user = User::all();
    	return view('register');
    }

    public function postRegister( Request $request)
    {
    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	$user->save();

    	return redirect('login');
    }

    public function getLoginAdmin()
    {
        return view('login');

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
            return redirect('index');
        }
        else
        {
            return redirect('login');
        }
    }
}
