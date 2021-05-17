<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Idea;
use App\Models\Trade;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReviewMail; 


class ContentController extends Controller
{
    public function showContent(Idea $idea) //メソッドインジェクション
    {
        $user = Auth::user();
        
        $trades = Trade::query()->orderBy('id', 'DESC')->get();

        $reviews = Review::pluck('review','id');
        //レビューを最新５件取得
        $rstreviews = Trade::query()->orderBy('id', 'DESC')
        ->whereNotNull('comment')
        ->where('idea_id', $idea->id)
        ->take(5)
        ->get();
        
        //不正アクセス防止
        foreach($trades as $trade){
            //ログインしてるユーザーのidがbuyer_idカラムに一致する値があり
            if (in_array($user->id, array($trade->buyer_id)) 
            //かつ、ログインしているユーザーのidがtradeテーブルのidea_idカラムに一致する値がある場合
                && (in_array($idea->id, array($trade->idea_id))
            )){
                //コンテンツページを表示する
                    return view('ideas.idea_content')
                        ->with('trade', $trade)
                        ->with('user', $user)
                        ->with('reviews', $reviews)
                        ->with('rstreviews', $rstreviews)
                        ->with('idea', $idea);       
            }
        } 
    }

    
    public function review(ReviewRequest $request, $id) // $idはサービス・プロバイダにより $id = 'id'
    {
        // アイディを評価する
        $t_id = Trade::find($id); // Tradeテーブルのidを検索して、$t_idへ代入
        $t_id->rates = $request->input('rates'); //５段評価
        $t_id->comment = $request->input('comment'); // 口コミ
        $t_id->save();

        // アイディアが評価されたメールを投稿者に送る
        $s_id = User::find($t_id->seller_id); //Userテーブルのseller_idを検索して、$s_idへ代入
        $s_name = $s_id->name;
        $s_mail = $s_id->email;
        $idea_name = $t_id->name;
        $price = $t_id->price;
        $rates = $request['rates'];
        $comment = $request['comment'];
        Mail::to($s_mail)->send(new ReviewMail($s_name, $idea_name, $price, $rates, $comment)); // Mail::send(); メールを送信

        // アイディアの平均評価を算出する
        $ideas = Idea::query()->get();
        // 生SQL SELECT AVG(rates) as avgrate FROM trades GROUP BY idea_id
        $avgs = DB::table('trades')
        ->select(DB::raw('idea_id, avg(rates) as avgrate'))
        ->groupBy('idea_id')
        ->orderBy('idea_id', 'DESC')
        ->get();

        foreach($ideas as $idea){
        foreach($avgs as $avg){
            if($idea->id === $avg->idea_id)
                $idea->avg_rate = $avg->avgrate;
                $idea->save();
            }
        }

        // 口コミ数を算出する
        // 生SQL SELECT AVG(rates) as avgrate FROM trades GROUP BY idea_id
        $counts = DB::table('trades')
        ->select(DB::raw('idea_id, count(rates) as countrate'))
        ->groupBy('idea_id')
        ->orderBy('idea_id', 'DESC')
        ->get();

        foreach($ideas as $idea){
        foreach($counts as $count){
            if($idea->id === $count->idea_id)
                $idea->count_rate = $count->countrate;
                $idea->save();
                }
        }

            return redirect()->back()
            ->with('status', 'レビューを投稿しました。');
    }
}