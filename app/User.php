<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use Notifiable;

    public function getAllUsers($user_id)
    {
        return $this->Where('id', '<>', $user_id)->paginate(5);
    }

    public function posts() {
        return $this->hasMany('App\Post');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'mail',
        'password',
        'following_id',
        'follows_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 多対多のリレーションを定義
    // フォロワー→フォロー
    public function followers()
    {
        return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
    }
    // フォロー→フォロワー
    public function follows()
    {
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
    }

    // フォローする
   public function follow($user_id)
   {
       return $this->follows()->attach($user_id);
   }

   // フォロー解除する
   public function unFollow($user_id)
   {
       return $this->follows()->detach($user_id);
   }

   // フォローしているか
   public function isFollowing($user_id)
   {
       return (boolean) $this->follows()->where('followed_id', $user_id)->first();
   }

   // フォローされているか
   public function isFollowed($user_id)
   {
       return (boolean) $this->followers()->where('following_id', $user_id)->first();
   }

}