<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Post extends Model
{

    protected $fillable = [
        'user_id', 'post',
    ];

    public function user() {
        return $this->belongsToMany('App\User');
    }
}
