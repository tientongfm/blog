<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Category;
use App\Slide;
use App\Typenews;
use App\News;
use App\Comment;
use App\User;

class PagesController extends Controller
{
    
    public function index(){

    	/*$category = Category::all();
    	return view('pages.trangchu', compact('category'));*/

    	return view('pages.index');
    }

    public function contact(){
    	/*$category = Category::all();
    	return view('pages.lienhe', compact('category'));*/

    	return view('pages.contact');
    }

    public function typenews( $id){
        $typenews = Typenews::find($id);
        //lay tin tuc o trong loai tin ra
        $news = News::where('id_type_news', $id)->paginate(5);
        return view('pages.typenews', compact('typenews', 'news'));
    }

    public function news($id){
        $news = News::find($id);
        $hotnews = News::where('hotnews', 1)->take(4)->get();
        $related_news = News::where('id_type_news', $news->id_type_news)->take(4)->get(); 
        return view('pages.news', compact('news', 'hotnews', 'related_news'));
    }

    public function getLogin(){
        return view('pages.login');
    }

    public function postLogin( Request $request){
        $this->validate($request,[
            'email'=>'required',
            'password' => 'required|min:3|max:32',
            ],[
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhât 3 ký tự',
            'password.max' => 'Mật khẩu quá dài, mật khẩu nhỏ hơn 32 ký tự',
        ]);


        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('index')->with('thongbao', 'Đăng nhập thành công');
        }
        else{
            return redirect('user_login')->with('thongbao', 'Đăng nhập không thành công');
        }
    }

    public function getLogout(){
        Auth::logout();
        return view('pages.index');
    }

    
    
}
