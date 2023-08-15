<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use Auth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $this->middleware('auth');

        $value = $request->session()->get('username');
        $value = session('username');
        $value = Session::get('username');
        $request->session()->put('username', 'value');

        $post = Post::all();
        return view('posts.index', compact('post'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $post = new Post();//postsテーブルの中身を$postに入れている
        $post->post = $request->main;//name属性
        $post->user_id = Auth::id();
        $post->save();

        return redirect('/top');
    }

    public function updateForm($id)
    {
        $post = \DB::table('posts')
            ->where('id', $id)
            ->first();
        return view('posts.updateForm', compact('post'));
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $up_post = $request->input('upPost');
        \DB::table('posts')
            ->where('id', $id)
            ->update(
                ['post' => $up_post]
            );

        return redirect('/top');
    }

    public function delete($id)
    {
        \DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('/top');
    }

    public function show(){
        // Postモデル経由でpostsテーブルのレコードを取得
        $posts = Post::get();
        return view('follows.followList', compact('posts'));
      }

}
