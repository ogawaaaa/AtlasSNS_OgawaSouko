<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
//Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->middleware('guest');
Route::post('/login', 'Auth\LoginController@login')->middleware('guest');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::get('/top', 'PostsController@index')->middleware('auth');
Route::post('/top', 'PostsController@index')->middleware('auth');
//Route::get('/top','FollowsController@show')->middleware('auth');

Route::get('/store','PostsController@store');
Route::post('/store','PostsController@store');

Route::get('post/{id}/update-form', 'PostsController@updateForm');

Route::post('/update', 'PostsController@update');

Route::get('post/{id}/delete', 'PostsController@delete');

Route::get('/search','UsersController@search');
Route::get('/users/{user}/follow', 'FollowsController@follow')->name('follow');
Route::post('/users/{user}/follow', 'FollowsController@follow')->name('follow');
Route::get('/users/{user}/unFollow', 'FollowsController@unFollow')->name('unFollow');
Route::delete('/users/{user}/unFollow', 'FollowsController@unFollow')->name('unFollow');

Route::get('/follow-list','FollowsController@followList');
Route::post('/follow-list','FollowsController@followList');
Route::get('/follower-list','FollowsController@followerList');
Route::post('/follower-list','FollowsController@followerList');

//プロフィール編集画面表示
Route::get('/profile', 'UsersController@profile')->name('profile');
//プロフィール編集
Route::put('/profile', 'UsersController@profileUpdate')->name('profile_edit');
//パスワード編集
Route::put('/password_change', 'UserController@passwordUpdate')->name('password_edit');

Route::get('/logout', 'Auth\LoginController@logout');
Route::post('/logout', 'Auth\LoginController@logout');

