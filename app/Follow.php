<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Follow extends Model
{
    protected $primaryKey = [
        'following_id',
        'followed_id'
    ];
    protected $fillable = [
        'following_id',
        'followed_id'
    ];
    public $timestamps = false;
    public $incrementing = false;

    public function users() {
        return $this->belongsToMany('App\User');
    }

    protected $table = 'follows';

    public function getFollowCount($user_id)
  {
      return $this->where('following_id', $user_id)->count();
  }

  public function getFollowerCount($user_id)
  {
      return $this->where('followed_id',  $user_id)->count();
  }
}