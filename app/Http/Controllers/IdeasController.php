<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Idea;
use App\Models\Trade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\BoughtMail;
use App\Mail\SoldMail; 


class IdeasController extends Controller
{
    // アイディア一覧について
    public function showIdeas(Request $request)
    {
        $query = Idea::query();

        // カテゴリで絞り込み
        if ($request->filled('category')) {
            list($categoryType, $categoryID) = explode(':', $request->input('category'));

            if ($categoryType === 'c_id') {
                $query->whereHas('category', function ($query) use ($categoryID) {
                    $query->where('category_id', $categoryID);
                });
            }
        }

        // 投稿日 以上で絞り込み
        if ($request->filled('aboveday')) {
            $updateIdea = $this->escape($request->input('aboveday'));
            $query->whereDate('updated_at','>=', $updateIdea);
            //$query->orwhereMonth('updated_at', $update)->orwhereDay('updated_at', $update);
        }

          // 投稿日 以下で絞り込み
          if ($request->filled('belowday')) {
            $updateIdea = $this->escape($request->input('belowday'));
            $query->whereDate('updated_at','<=', $updateIdea);
            //$query->orwhereMonth('updated_at', $update)->orwhereDay('updated_at', $update);
        }

        // 価格 以上で絞り込み
        if ($request->filled('aboveprice')) {
            $abovePrice = $this->escape($request->input('aboveprice'));
            $query->where('price','>=', $abovePrice);
        }

        // 価格 以下で絞り込み
        if ($request->filled('belowprice')) {
            $belowPrice = $this->escape($request->input('belowprice'));
            $query->where('price','<=', $belowPrice);
        }

        // キーワードで絞り込み （要件にないので実装しないことにした）
        // if ($request->filled('keyword')) {
        //     $keyword = '%' . $this->escape($request->input('keyword')) . '%';
        //     $query->where(function ($query) use ($keyword) {
        //         $query->where('name', 'LIKE', $keyword);
        //         $query->orWhere('description', 'LIKE', $keyword);
        //     });
        // }


        // ページャー
        $ideas = $query->orderBy('id', 'DESC')
                        ->paginate(8);

        return view('ideas.ideas')
            ->with('ideas', $ideas);
    }

    private function escape(string $value)
    {
         return str_replace(
             ['\\', '%', '_'],
             ['\\\\', '\\%', '\\_'],
             $value
         );
    }

    // アイディアの詳細について
    public function showIdeaDetail(Idea $idea)
    {
        $user = Auth::user();
        $trades = Trade::query()->get();
        $reviews = Trade::query()->orderBy('id', 'DESC')
            ->whereNotNull('comment')
            ->where('idea_id', $idea->id)
            ->take(5)
            ->get();

        // 再購入できなくする
        foreach($trades as $trade){
            if (in_array($user->id, array($trade->buyer_id))
                && ( in_array($idea->id, array($trade->idea_id))) )
            {
                return redirect()->route('idea.content', [$trade->idea_id]);
            }
        }

        return view('ideas.idea_detail') // ideas/idea_detail.blade.php
            ->with('user', $user)
            ->with('trades', $trades)
            ->with('reviews', $reviews)
            ->with('idea', $idea);
    }

    public function showIdeaReview(Idea $idea)
    {
        $user = Auth::user();
        // レビューを新しい順で取得
        $trades = Trade::query()->orderBy('id', 'DESC')
            ->whereNotNull('comment')
            ->where('idea_id', $idea->id)
            ->paginate(10);

            return view('ideas.idea_review')
                ->with('user', $user)
                ->with('trades', $trades)
                ->with('idea', $idea);
    }

    // アイディア購入ついて確認
    public function showBuyIdeaForm(Idea $idea)
     {
        $user = Auth::user();
        $trades = Trade::query()->get();

        // 再購入できなくする
        foreach($trades as $trade){
            if (in_array($user->id, array($trade->buyer_id))
                && ( in_array($idea->id, array($trade->idea_id))) )
            {
                return redirect()->route('idea.content', [$trade->idea_id]);
            }
        }

        // 自分のアイディアは購入できない        
        if ($idea->seller_id !== $user->id) {
            return view('ideas.idea_buy_form')
            ->with('user', $user)
            ->with('idea', $idea);
            }
        }

    // アイディア購入処理について
    public function buyIdea(Request $request, Idea $idea, Trade $trade)
    {
        $user = Auth::user();
        // アイディアを購入した際にTradesテーブルにデータを入力する
        try {
            $idea->state = Idea::STATE_BOUGHT;

            $trade->idea_id = $idea->id;
            $trade->name = $idea->name;
            $trade->category_id = $idea->category_id;
            $trade->description = $idea->description;
            $trade->price = $idea->price;
            $trade->seller_id = $idea->seller_id;
            $trade->buyer_id  = $user->id;
 
            $idea->save();
            $trade->save();

         } catch (\Exception $e) {
            // エラーが発生した場合の処理
             Log::error($e);
             return redirect()->back()
                 ->with('type', 'danger')
                 ->with('message', '購入処理が失敗しました。');
        }

        // 売買後に購入者と投稿者にメールを送る処理

        $idea_name = $idea->name; // アイディア名
        $price = $idea->price;  // アイディアの価格
        $b_name = $user->name; //buyerの名前

        $s_id = User::find($idea->seller_id); //Userテーブルからseller_idが一致するレコードを抽出
        $s_name = $s_id->name;  // sellerの名前
        $s_mail = $s_id->email; // sellerのメアド

        Mail::to($user->email)->send(new BoughtMail( $b_name, $idea_name, $price));  // buyerにメール
        Mail::to($s_mail)->send(new SoldMail($s_name, $idea_name, $price)); // sellerにメール
 
        return redirect()->route('idea.content', [$idea->id])
            ->with('status', 'アイディアを購入しました。');
    }

    // 気になるリストに登録する処理
    public function like(Request $request, Idea $idea)
    {
        //モデルを結びつけている中間テーブルにレコードを削除する。 
        $idea->likes()->detach($request->user()->id);
        // モデルを結びつけている中間テーブルにレコードを挿入する。 
        $idea->likes()->attach($request->user()->id);
    }

    // 気になるリストから削除する処理
    public function unlike(Request $request, Idea $idea)
    {
        $idea->likes()->detach($request->user()->id);
    }  
}