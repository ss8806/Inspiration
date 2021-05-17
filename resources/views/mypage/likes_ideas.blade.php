@extends('layouts.app')

@section('title')
    気になるリスト
@endsection

@section('content')
        <div class="c-title c-title__index">
            <p>気になるリスト</p>
        </div>

        <div class="p-card">
            <div class="c-flexbox--index">
                <div class="c-flexbox__flexcontainer c-flexbox__flexcontainer--index">  
                    @foreach ($likes as $like)
                    @foreach ($ideas as $idea)
                    @if( $like->idea_id === $idea->id) <!-- 気になるに登録したアイディアを展開 -->
                        
                            <idea-like
                            :idea='{{$idea}}'
                            :category='{{$idea->Category}}'
                            route="{{ route('idea', [$like->idea_id]) }}"
                            :initial-is-liked-by='@json($idea->isLikedBy(Auth::user()))'
                            :initial-count-likes='@json($idea->count_likes)'
                            :authorized='@json(Auth::check())'
                            endpoint="{{ route('ideas.like', ['idea' => $idea]) }}"  
                            >
                            </idea-like>
                        
                    @endif
                    @endforeach
                    @endforeach
                    
                </div>
            </div>
        </div>
        <br>
         <!-- ページャー  -->
         <div class="c-pager">
                {{ $likes->links() }}
        </div>

@endsection