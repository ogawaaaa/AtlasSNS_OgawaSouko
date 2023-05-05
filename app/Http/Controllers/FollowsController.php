<?php

namespace App\Http\Controllers;
use App\User;
use App\Post;
use App\Follow;
use Auth;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function follow($id)
   {
    ddd($id);
    //    $follower = auth()->user();
    //     //フォローしているか
    //    $is_following = $follower->isFollowing($user->id);
    //    if($is_following) {
    //     // フォローしていなければフォローする
    //     $follower->follow($user->id);
    //     return back();
    //    }
   }
   //public function follow(User $user) {
    //$follow = Follow::create([
      //  'following_id' => \Auth::user()->id,
        //'followed_id' => $user->id,
    //]);

    //if($is_following){
    //$follower->follow($user->id);
    //return back();
    //}
   //}

   public function unFollow(User $user)
   {
       $follower = auth()->user();
       // フォローしているか
       $is_following = $follower->isFollowing($user->id);
       if($is_following) {
        // フォローしていればフォローを解除する
        $follower->unFollow($user->id);
        return back();
        }
    }

    //public function unFollow(User $user) {
      //  $follow = Follow::where('following_id', \Auth::user()->id)->where('followed_id', $user->id)->first();
        //$follow->delete();
        //$followCount = count(Follow::where('followed_id', $user->id)->get());

        //if($is_following) {
        //$follower->unFollow($user->id);
      //  return back();
    //}
   //}

    public function followList(){
        $user = Auth::user();
        //$follows = auth()->user()->follows()->get();
        //$follow_ids = $follow_ids->pluck('followed_id')->toArray();
        $following_id = Auth::user()->follows()->pluck('followed_id');
        $posts = Post::with('user')->whereIn('user_id', $following_id)->get();
        return view('follows.followList', compact('posts'));
    }

    public function followerList(){
        $user = Auth::user();
        $followed_id = Auth::user()->follows()->pluck('following_id');
        $posts = Post::with('user')->whereIn('user_id', $followed_id)->get();
        return view('follows.followerList' , compact('posts'));
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
