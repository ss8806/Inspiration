@extends('layouts.app')

@section('title')
    {{$idea->name}} | アイディア詳細
@endsection

@section('content')
    <div class="p-card--product">        
        <div class="c-session">
            @if (session('message'))
                <div class="c-session" role="alert">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <div class="p-card__header u-overflow">{{$idea->name}}</div>

        <div class="p-card__body">
            @include('ideas.idea_detail_panel', ['idea' => $idea])

            <div class="c-twitter">
                <a href="https://twitter.com/intent/tweet?button_hashtag=アイデア&ref_src=twsrc%5Etfw" 
                class="twitter-hashtag-button"  data-show-count="false">Tweet #アイデア</a>
                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>

            <div class="c-btn c-btn__like">
                <like-button
                :initial-is-liked-by='@json($idea->isLikedBy(Auth::user()))'
                :initial-count-likes='@json($idea->count_likes)'
                :authorized='@json(Auth::check())'
                endpoint="{{ route('ideas.like', ['idea' => $idea]) }}"  
                >
                </like-button>
            </div>
                
            <div class="c-btn">
                @if ($idea->seller_id === $user->id && $idea->state === 'editable')
                    <button class="c-btn__edit" onclick="location.href='{{route('edit', [$idea->id])}}'">編集する</button>
                @elseif ($idea->seller_id === $user->id && $idea->state === 'bought')
                    <button>購入されたため編集不可です。</button>
                @else
                <button class="c-btn__buy" onclick="location.href='{{ route('idea.buy', [$idea->id])}}' ">購入する</button>
                @endif
            </div>
        </div>

        <div class="p-card__footer">
            <div class="p-review">
                <p>口コミ一覧</p>
                <table class="p-table p-table--review" >
                    <tr class="p-table__border">
                        <th class="p-table__border p-table__ws">評価</th>
                        <td class="p-table__cell">コメント</td>
                    </tr>
                </table>
                @foreach ($reviews as $review)
                    @if($idea->id === $review->idea_id)
                        <table class="p-table p-table--review u-border__none--top">
                            <tr class="p-table__border u-border__none--top">
                                <th class="p-table__border p-table__ws u-border__none--top"u-border__none--top>{{$review->rates}}</th>
                                <td class="p-table__left">{{$review->comment}}</td>
                            </tr>
                        </table>
                    @endif
                @endforeach
            
                <div class="c-link__review">
                    <a href="{{route('idea.review', [$idea->id])}}" class="c-btn">口コミをすべて見る</a>
                </div>
            </div>
        </div>
    </div>

@endsection