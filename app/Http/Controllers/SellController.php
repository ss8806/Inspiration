<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellRequest;
use App\Models\Idea;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellController extends Controller
{
    // アイディアを出品画面について
    public function showSellForm()
    {
        $categories = Category::orderBy('sort_no')->get();

        return view('sell')
             ->with('categories', $categories);
    }

    // アイディアを出品する処理について
    public function sellIdea(SellRequest $request)
    {
        $user = Auth::user();

        $idea                        = new Idea();
        $idea->seller_id             = $user->id;
        $idea->category_id           = $request->input('category');
        $idea->name                  = $request->input('name');
        $idea->description           = $request->input('description');
        $idea->content               = $request->input('content');
        $idea->price                 = $request->input('price');
        $idea->state                 = Idea::STATE_EDITABLE;
        $idea->save();

        return redirect()->back()
            ->with('status', 'アイディアを投稿しました。');
    }
}
