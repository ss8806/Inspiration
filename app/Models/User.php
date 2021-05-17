<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function soldIdeas()
    {
    //第二引数には多側のキー(外部キー)であるseller_idを指定,これによりsoldIdeasメソッドsellerが投稿したアイデアを取得できる。
        return $this->hasMany(Idea::class, 'seller_id');
    }

    //第二引数には多側のキー(外部キー)であるbuyer_idを指定,これによりBoughtIdeasメソッドでbuyerが購入したアイデアを取得できる。
    public function boughtIdeas()
    {
        return $this->hasMany(Trade::class, 'buyer_id');
    }

    //第二引数には多側のキー(外部キー)であるuser_idを指定,これによりlikesIdeasメソッドでuserが気になるしたアイデアを取得できる。
    public function likesIdeas()
    {
        return $this->hasMany(Like::class, 'user_id');
    }

    //第二引数には多側のキー(外部キー)であるseller_idを指定,これによりreviewItemsメソッドでbuyerが評価したアイデアを取得できる。
    public function reviewIdeas()
    {
        return $this->hasMany(Trade::class, 'seller_id');
    }
}
