<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoughtIdeasController extends Controller
{
    public function showBoughtIdeas()
    {
        $user = Auth::user();
        //購入したアイディアを取得 boughtIdeasは Models/Userで定義
        $ideas = $user->boughtIdeas()->orderBy('id', 'DESC')->paginate(8);

        

        return view('mypage.bought_ideas')
            ->with('ideas', $ideas);
    }
}
