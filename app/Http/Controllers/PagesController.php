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

    public function getUser(){
        $user = Auth::user();
        return view('pages.users', compact('user'));
    }

    public function postUser(Request $request){
        $this->validate($request,[
                'name' => 'required|min:3',
                
            ],[
                'name.required' => 'Bạn chưa nhập tên người dùng',
                'name.min' => 'Tên người dùng phải có ít nhất 3 ký tự',

            ]);

        $user = Auth::user();
        $user->name = $request->name;

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
        return redirect('user')->with('thongbao', 'Bạn đã sửa thành công');

    }

    function getRegister(){
        return view('pages.register');
    }

    function postRegister(Request $request){

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
        $user->level = 0;
        $user->save();

        return redirect('login')->with('thongbao','Đăng ký thành công');
    }

    public function search(Request $request){
        $key = $request->key;
        //Tim kiem theo tieu de. toan tu so sanh like. voi tu khoa key
        $news = News::where('title', 'like', "%$key%")->orWhere('summary', 'like', "%$key%")->orWhere('content', 'like', "%$key%")->paginate(5);
        return view('pages.search', compact('key', 'news'));

    }
       
}
