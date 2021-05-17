<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Idea;

class MypageController extends Controller
{
    public function showMypage()
    {
        $user = Auth::user();
        // 購入、投稿、気になるに登録、評価されたアイディアを最新５件表示取得
        $boughts = $user->boughtIdeas()->orderBy('id', 'DESC')->take(5)->get();
        $solds = $user->soldIdeas()->orderBy('id', 'DESC')->take(5)->get();
        $likes = $user->likesIdeas()->orderBy('id', 'DESC')->take(5)->get();
        $reviews = $user->reviewIdeas()->orderBy('id', 'DESC')->whereNotNull('comment')->take(5)->get();
        $ideas = Idea::query()->get();

        return view('mypage.mypage')
            ->with('boughts', $boughts)
            ->with('solds', $solds)
            ->with('likes', $likes)
            ->with('reviews', $reviews)
            ->with('ideas', $ideas)
            ->with('user', $user); 
    }
}
