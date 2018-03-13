<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use App\Comment;
use App\News;
use App\User;

class CommentController extends Controller
{
    public function postComment($id, Request $request){
    	/*return $id;
    	die();*/
    	//gan id tin tuc bang $id
    	/*$id_news = $id;*/
    	$news = News::find($id);
    	$comment = new Comment;
    	$comment->id_news = $id;
        $comment->id_user = Auth::user()->id;
        $comment->content = Input::get('content');
       
    	
    	$comment->save();

    	return redirect('news/'.$news->id .'/' .$news->name_without_accent.'.html')->with('thongbao', 'Viết bình luận thành công');


    }
}
