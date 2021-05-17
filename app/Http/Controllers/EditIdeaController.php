<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellRequest;
use App\Models\Idea;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditIdeaController extends Controller
{
    public function showEditForm(Idea $idea)
    {
        $user = Auth::user();
        $categories = Category::pluck('name','id');

        // 不正アクセス防止 投稿者でかつアイディアが編集可能でなければ編集できない
        if ($user->id === $idea->seller_id && $idea->state === 'editable'){

            return view('edit')
                ->with('categories', $categories)
                ->with('user', $user)
                ->with('idea', $idea);
        } 
    }
    public function editIdea(SellRequest $request, $id)
    {
        $idea = Idea::find($id);
        $idea->category_id      = $request->input('category');
        $idea->name             = $request->input('name');
        $idea->description      = $request->input('description');
        $idea->content          = $request->input('content');
        $idea->price            = $request->input('price');
        $idea->save();

        return redirect()->back()
            ->with('status', 'アイディアを編集しました。');
    }

    // アイディアを削除する
    public function destroyIdea($id)
    {
        $user = Auth::user();

        $idea = Idea::find($id);

        if($user->id == $idea->seller_id){
            $idea->delete();        

            return redirect('/mypage/mypage')
            ->with('status', 'アイディアを削除しました。');
        }
    }
}
