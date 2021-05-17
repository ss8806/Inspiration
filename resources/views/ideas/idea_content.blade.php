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
            <div class="p-panel__product">
                <table class="p-table p-table--product" >
                    <tr class="p-table__border">
                        <th class="p-table__border p-table__ws" >投稿者</th>
                        <td class="p-table__left">
                            @if (!empty($idea->seller->avatar_file_name))
                                <img src="https://backend0622.s3-ap-northeast-1.amazonaws.com/{{$idea->seller->avatar_file_name}}" class="c-avatar">
                                <!-- <img src="/storage/avatars/{{$idea->seller->avatar_file_name}}" class="c-avatar"> -->
                            @else
                                <img src="/images/avatar-default.svg" class="c-avatar">
                            @endif
                            {{$idea->seller->name}}
                        </td>
                    </tr>
                    <tr class="p-table__border">
                        <th class="p-table__border p-table__ws">カテゴリー</th>
                        <td class="p-table__left">{{$idea->Category->name}}</td>
                    </tr>
                    <tr class="p-table__border">
                        <th class="p-table__border p-table__ws">概要</th>
                        <td class="p-table__left ">{{$idea->description}}</td>
                    </tr>
                    <tr class="p-table__border">
                        <th class="p-table__border p-table__ws">内容</th>
                        <td class="p-table__left">{{$idea->content}}</td>         
                    </tr>
                    <tr class="p-table__border">
                        <th class="p-table__border p-table__ws">平均評価</th>
                        <td class="p-table__left">{{number_format($idea->avg_rate,1)}}点</td>
                    </tr>
                </table>
            </div>

       
            <div class="c-price">
                <i class="fas fa-yen-sign"></i>
                <span class="ml-1">{{$idea->price}}</span>
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
        </div>

        <div class="p-card__footer">
            <div class="p-review">
                <form class="p-from__review" method='POST' action="{{ route('review',$trade->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="p-review">
                            <p>５段階評価</p>
                            <select class="c-form c-form__review" type="text" name="rates">

                                @foreach ($reviews as $r_id => $r_name)
                                    @if ($trade->rates === null)
                                        <option value="" style="display: none;" >選択してください</option>
                                        <option value="{{ $r_id }}" @if(old('review') == "$r_id") selected @endif> {{$r_name}} </option>
                                    @else
                                        <option value="{{$trade->rates}}" style="display: none;">{{$trade->rates}}</option>
                                        <option value="{{ $r_id }}" @if(old('review') == "$r_id") selected @endif> {{$r_name}} </option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="c-error">
                                @error('rates')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            



                            <p>口コミを投稿</p>
                            <div class="form-group">
                                <textarea class="c-form c-form__comment" name="comment" placeholder="口コミを入力">{{ old('comment', $trade->comment) }}</textarea>
                                <div class="c-error">
                                    @error('comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @if ($trade->comment === null)
                                <input type="submit" class="c-btn" value="レビューを投稿">
                            @else
                                <input type="submit" class="c-btn" value="レビューを編集">
                            @endif
                    </div>
                </form>

                <p>口コミ一覧</p>
                <table class="p-table p-table--review" >
                    <tr class="p-table__border">
                        <th class="p-table__border p-table__ws" >評価</th>
                        <td class="p-table__cell">コメント</td>
                    </tr>
                </table>
                @foreach ($rstreviews as $rstreview)
                    @if($idea->id === $rstreview->idea_id)
                        <table class="p-table p-table--review u-border__none--top">
                            <tr class="p-table__border u-border__none--top">
                                <th class="p-table__border p-table__ws u-border__none--top">{{$rstreview->rates}}</th>
                                <td class="p-table__left">{{$rstreview->comment}}</td>
                            </tr>
                        </table>
                    @endif
                @endforeach
            
                <div class="p-link__review">
                    <a href="{{route('idea.review', [$idea->id])}}" class="c-btn">口コミをすべて見る</a>
                </div>  
            </div>
        </div>
    </div>
@endsection