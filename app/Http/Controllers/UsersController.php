<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;


class UsersController extends Controller
{

    public function index(User $user)
    {
        $all_users = $user->getAllUsers(auth()->user()->id);

        return view('users.index', [
            'all_users'  => $all_users
        ]);
    }

    public function profile(){
        return view('users.profile');
    }

    public function search(Request $request){
        $user = User::all();
        $keyword = $request -> input('keyword');
        $search = $request->input('search');

        $query = User::query();

        if (!empty($keyword)) {
            $query->where('username', 'LIKE', "%{$keyword}%");
        }

        $user = $query->get();

        return view('users.search', compact('user', 'keyword', 'search'));
    }

    public function show(User $user, Follower $follower)
    {
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($user->id);
        $is_followed = $login_user->isFollowed($user->id);
        $timelines = $tweet->getUserTimeLine($user->id);
        $follow_count = $follower->getFollowCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);

        return view('users.show', [
            'user'           => $user,
            'is_following'   => $is_following,
            'is_followed'    => $is_followed,
            'timelines'      => $timelines,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }
}
