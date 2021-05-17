@extends('layouts.app')

@section('title')
    マイページ
@endsection

@section('content')
    <div class="c-session">
        @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
        @endif
    </div>

    {{-- アイコン画像 --}}
    <div class="c-avatar__mypage">
        <img src="/images/avatar-default.svg" class="c-avatar c-avatar__mypage">
    </div>
    <button class="c-btn c-btn__mypage" type=“button” onclick="location.href='edit-profile'">プロフィール編集</button>

    
    <section class="p-list">
        <div class="p-card">
            <p class="c-title c-title__mypage"> 購入したアイデア</p>
            <a class="c-link__show--all"  href="{{ route('mypage.bought-ideas') }}">全件表示する</a>
            <div class="c-flexbox--mypage">
                <div class="c-flexbox__flexcontainer">
                    @foreach ($boughts as $bought)
                        <div class="c-flexbox__flexitem c-flexbox__flexitem--mypage">
                        <div class="p-card p-card__header--index u-overflow">{{$bought->name}}</div>
                            <div class="p-card__body">
                                <table class="p-table p-table--index">
                                    <td class="c_category">{{$bought->Category->name}}</td>
                                </table>
                                <table class="p-table p-table--index u-border__none--top">                    
                                    <td class="u-overflow"><p>概要</p>{{ $bought->description }}</td>
                                </table>
                                <table class="p-table p-table--index u-border__none--top">
                                    <td>購入日<span class="u-br">{{ date('Y年m月d日', strtotime($bought->updated_at)) }}</td> 
                                </table>
                                <table class="p-table p-table--index u-border__none--top">
                                    <td class="">{{number_format($bought->price)}}円</td>
                                </table>
                            </div>
                            <div p-card__fotter>
                                    <a href="{{ route('idea.content', [$bought->idea_id]) }}" >詳細を見る</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <section class="p-list">
        <div class="p-card">
            <p class="c-title c-title__mypage"> 気になるリスト</p>
            <a class="c-link__show--all"  href="{{ route('mypage.likes-ideas') }}">全件表示する</a>
            <div class="c-flexbox--mypage">
                <div class="c-flexbox__flexcontainer">
                @foreach ($likes as $like)
                @foreach ($ideas as $idea)
                @if( $like->idea_id === $idea->id)
                <div class="c-flexbox__flexitem c-flexbox__flexitem--mypage">
                        <div class="p-card p-card__header--index u-overflow">{{$idea->name}}</div>
                        <div class="p-card p-card__body">
                            <table class="p-table p-table--index">
                                <td class="c_category">{{$idea->Category->name}}</td>
                            </table>
                            <table class="p-table p-table--index u-border__none--top">                    
                                <td class="u-overflow"><p>概要</p>{{ $idea->description }}</td>
                            </table>

                            <table class="p-table p-table--index u-border__none--top">
                                <td>登録日<span class="u-br">{{ date('Y年m月d日', strtotime($idea->updated_at)) }}</td>
                            </table>
                            <table class="p-table p-table--index u-border__none--top">
                                    <td class="">{{number_format($idea->price)}}円</td>
                            </table>
                            <div class="p-card__footer">
                                <div>
                                    <a href="{{ route('idea', [$like->idea_id]) }}">詳細をみる</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @endforeach
                @endforeach
            </div>
        </div>
    </section>

    <section id="sold">
        <div class="p-card">
                <p class="c-title c-title__mypage">投稿したアイデア</p>
                <a class="c-link__show--all"  href="{{ route('mypage.sold-ideas') }}">全件表示する</a>
                
                <div class="c-flexbox--mypage">
                <div class="c-flexbox__flexcontainer">
                @foreach ($solds as $sold)
                    <div class="c-flexbox__flexitem c-flexbox__flexitem--mypage">
                        <div class="p-card p-card__header--index u-overflow">{{$sold->name}}</div>
                        <div class="p-card p-card__body">    
                        <table class="p-table p-table--index">
                                <td class="c_category">{{$sold->Category->name}}</td>
                        </table>
                        <table class="p-table p-table--index u-border__none--top">                    
                            <td class="u-overflow"><p>概要</p>{{ $sold->description }}</td>
                        </table>
                        <table class="p-table p-table--index u-border__none--top">
                            <td>投稿日<span class="u-br">{{ date('Y年m月d日', strtotime($sold->updated_at)) }}</td> 
                        </table>
                        <table class="p-table p-table--index u-border__none--top">
                            <td class="">{{number_format($sold->price)}}円</td>
                        </table>
                        @if ($sold->state === 'editable')
                            <a class="c-link" href="{{ route('edit', [$sold->id]) }}">編集する</a>
                        @endif           
                        <a class="c-link" href="{{ route('idea', [$sold->id]) }}">詳細をみる</a>
                        </div>
                    </div>
                @endforeach
                </div>
            
        </div>
    </section>

    <section id="review_list">
        <div class="p-card">
            <p class="c-title c-title__mypage"> 投稿されたレビュー</p>
            
                <a class="c-link__show--all" href="{{ route('mypage.review-ideas') }}">全件表示する</a>    
                <div class="c-flexbox--mypage">
                    <div class="c-flexbox__flexcontainer">
                    @foreach ($reviews as $review)
                        <div class="c-flexbox__flexitem c-flexbox__flexitem--mypage">                        
                            <div class="p-card p-card__header--index u-overflow">{{$sold->name}}</div>
                            <div class="p-card__body">
                                <table class="p-table p-table--index">
                                    <td class="c_category">{{$review->Category->name}}</td>
                                </table>
                                <table class="p-table p-table--index u-border__none--top">                    
                                    <td class="u-overflow"><p>概要</p>{{ $review->description }}</td>
                                </table>
                                <table class="p-table p-table--index u-border__none--top">                    
                                    <td class="u-overflow"><p>コメント</p>{{ $review->comment}}</td>
                                </table>
                                <table class="p-table p-table--index u-border__none--top">
                                    <td>評価{{$review->rates}}</td>
                                </table>
                                <table class="p-table p-table--index u-border__none--top">
                                    <td>投稿日<span class="u-br">{{$review->updated_at->format('Y年n月j日')}}</td>
                                </table>
                            </div>
                            <div class="p-card__footer">
                                <a href="{{ route('idea', [$sold->id]) }}">詳細をみる</a>
                            </div>
                        </div> 
                    @endforeach
                </div>
        </div>  
    </section>

@endsection