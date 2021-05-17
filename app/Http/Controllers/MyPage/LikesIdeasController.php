<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Idea;

class LikesIdeasController extends Controller
{
    public function showLikesIdeas()
    {
        $user = Auth::user();
        // 気になるに登録したアイディアを取得 likesIdeasは Models/Userで定義
        $likes = $user->likesIdeas()->orderBy('id', 'DESC')->paginate(8);

        $ideas = Idea::query()->get();


        return view('mypage.likes_ideas')
            ->with('likes', $likes)
            ->with('ideas', $ideas);
    }
}