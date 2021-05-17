@extends('layouts.app')

@section('title')
    投稿されたレビュー一覧
@endsection

@section('content')
    <div class="c-title c-title__index">
        <p>投稿されたレビュー一覧</p>
    </div>

    <div class="p-card">
        <div class="c-flexbox--index">
            <div class="c-flexbox__flexcontainer c-flexbox__flexcontainer--index">
                @foreach ($ideas as $idea) <!--  投稿したアイディアを展開 -->
                    @if($idea->comment !== null) 
                    <div class=" c-flexbox__flexitem c-flexbox__flexitem--index">           
                        <div class="p-card p-card__header--index">{{$idea->name}}</div>
                        <div class="p-card__body">
                            <table class="p-table p-table--index">
                                <td class="c_category">{{$idea->Category->name}}</td>
                            </table>
                            <table class="p-table p-table--index u-border__none--top">                    
                                <td class="u-overflow"><p>概要</p>{{ $idea->description }}</td>
                            </table>
                            <table class="p-table p-table--index u-border__none--top">                    
                                <td class="u-overflow"><p>コメント</p>{{ $idea->comment}}</td>
                            </table>
                            <table class="p-table p-table--index u-border__none--top">
                                <td>評価{{$idea->rates}}</td>
                            </table>
                            <table class="p-table p-table--index u-border__none--top">
                                <td>投稿日{{$idea->updated_at->format('Y年n月j日')}}</td>
                            </table>
                        </div>
                        <div class="p-card__footer">
                            <a href="{{ route('idea', [$idea->idea_id]) }}">詳細をみる</a>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <!-- ページャー  -->
    <div class="c-pager">
        {{ $ideas->links() }}
    </div>
@endsection