<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoldIdeasController extends Controller
{
    public function showSoldIdeas()
    {
        $user = Auth::user();
        // 投稿したアイディアを取得 soldIdeasは Models/Userで定義
        $ideas = $user->soldIdeas()->orderBy('id', 'DESC')->paginate(8);

        return view('mypage.sold_ideas')
            ->with('ideas', $ideas);
    }
}
