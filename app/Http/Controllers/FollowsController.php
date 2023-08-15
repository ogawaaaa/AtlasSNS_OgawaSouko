<?php

namespace App\Http\Controllers;
use App\User;
use App\Post;
use App\Follow;
use Auth;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function follow(User $user)
   {
       $follower = Auth::user();
        //フォローしているか
       $is_following = $follower->isFollowed($user->id);
       if($is_following) {
        // フォローしていなければフォローする
       $follower->follow($user->id);
        return back();
       }
   }

   public function unFollow(User $user)
   {
       $follower = Auth::user();
       // フォローしているか
       $is_following = $follower->isFollowing($user->id);
       if($is_following) {
        // フォローしていればフォローを解除する
        $follower->unFollow($user->id);
        return back();
        }
    }

    public function followList(){
        $follows = AUth::User()->follows()->get();
        $following_id = Auth::user()->follows()->pluck('followed_id');
        $posts = Post::with('user')->whereIn('user_id', $following_id)->get();
        //dd($posts);
        return view('follows.followList' , ['follows' => $follows,'posts' => $posts]);
    }

    public function followerList(){
        $follows = AUth::User()->follows()->get();
        $followed_id = Auth::user()->follows()->pluck('following_id');
        $posts = Post::with('user')->whereIn('user_id', $followed_id)->get();
        return view('follows.followerList' , ['follows' => $follows,'posts' => $posts]);
    }

    public function show(Follow $follow)
    {
        $user = Auth::user();
        $follow_count = $follow->getFollowCount($user->id);
        $follower_count = $follow->getFollowerCount($user->id);

        return view('layouts.login', [
            'user'           => $user,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }
}
