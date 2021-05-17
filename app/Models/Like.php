<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
        //お気に入りに登録したアイディアを見る際にカテゴリーを表示させる
        public function Category() 
        {
            return $this->belongsTo(Category::class);
        }
}