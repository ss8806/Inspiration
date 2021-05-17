<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    //購入したアイディアを見る際にカテゴリーを表示させる
    public function Category() 
    {
        return $this->belongsTo(Category::class);
    }
   
}
