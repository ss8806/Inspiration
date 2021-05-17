<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReviewIdeasController extends Controller
{
    public function showReviewIdeas()
    {
    $user = Auth::user();
        // レビューされたアイディを取得 reviewIdeasは Models/Userで定義
        $ideas = $user->reviewIdeas()->orderBy('id', 'DESC')
        ->whereNotNull('comment')
        ->paginate(8);
 
        return view('mypage.review_ideas')
            ->with('ideas', $ideas);
    }
}
