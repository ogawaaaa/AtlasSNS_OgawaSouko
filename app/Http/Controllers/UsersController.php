<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\follow;
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
        $user = Auth::user();

        return view('users.profile', ['user' => $user]);
    }

    public function profileUpdate()
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
        ]);

        try {
            $user = Auth::user();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();

        } catch (\Exception $e) {
            return back()->with('msg_error', 'プロフィールの更新に失敗しました')->withInput();
        }

        return redirect()->route('articles_index')->with('msg_success', 'プロフィールの更新が完了しました');
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            $user = Auth::user();
            $user->password = bcrypt($request->input('password'));
            $user->save();

        } catch (\Exception $e) {
            return back()->with('msg_error', 'パスワードの更新に失敗しました')->withInput();
        }

        return redirect()->route('articles_index')->with('msg_success', 'パスワードの更新が完了しました');
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

    public function show()
    {
    }
}
