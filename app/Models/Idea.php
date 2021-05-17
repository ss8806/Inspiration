<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Idea extends Model
{
    // 編集可能
    const STATE_EDITABLE = 'editable';
    // 購入された
    const STATE_BOUGHT = 'bought';

    // 気になるリストについての処理
    public function likes(): BelongsToMany
    {
    // likesにおけるideaモデルとuserモデルの関係は多対多となる。 第二引数には中間テーブルlikesを指定
        return $this->belongsToMany('App\Models\User', 'likes')->withTimestamps();
    }

    public function isLikedBy(?User $user): bool
    {
    // $this->likesにより、ideaモデルからlikesテーブル経由で紐付くユーザーモデルが、コレクションで返る。
    // countメソッドは、コレクションの要素数を数えて、数値を返す
        return $user //三項演算子
            ? (bool)$this->likes->where('id', $user->id)->count() // このアイデアををお気に入りにしたユーザーの中に、引数として渡された$userがいれば、1かそれより大きい数値が返る
            : false; // このアイデアをいいねしたユーザーの中に、引数として渡された$userがいなければ、0が返る 
    }
    //(実装しない処理)
        //アクセサによりideasテーブルにはcount_likesというカラムはないが、カラムがあるかのように $idea->count_likesといった呼び出し方ができる
        // public function getCountLikesAttribute(): int
        // {
        //     return $this->likes->count(); //このアイデアにお気に入りをした全ユーザーモデルがコレクションで返る。これにより、このアイデアにお気に入りをしたユーザーの総数、つまりお気に入りの合計がでる。
        // }
    //

    // アイディアに紐づくカテゴリーを取得できる。
    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // アイディアに紐づく投稿者を取得できる。
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
