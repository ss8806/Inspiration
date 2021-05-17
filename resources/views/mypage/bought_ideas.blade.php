@extends('layouts.app')

@section('title')
    購入したアイデア一覧
@endsection

@section('content')
    <div class="c-title c-title__index">
        <p>購入したアイデア</p>
    </div>

    <div class="p-card">
        <div class="c-flexbox--index">
            <div class="c-flexbox__flexcontainer c-flexbox__flexcontainer--index">
                @foreach ($ideas as $idea) <!-- 購入したアイディアを展開 -->
                    <div class=" c-flexbox__flexitem c-flexbox__flexitem--index">                           
                        <div class="p-card p-card__header--index u-overflow">{{$idea->name}}</div>
                        <div class="p-card__body">
                            <table class="p-table p-table--index">
                                <td class="c_category">{{$idea->Category->name}}</td>
                            </table>
                            <table class="p-table p-table--index u-border__none--top">                    
                                <td class="u-overflow"><p>概要</p>{{ $idea->description }}</td>
                            </table>
                            <table class="p-table p-table--index u-border__none--top">
                                <td>購入日 {{ date('Y年m月d日', strtotime($idea->updated_at)) }}</td> 
                            </table>
                            <table class="p-table p-table--index u-border__none--top">
                                <td class="">{{number_format($idea->price)}}円</td>
                            </table>
                        </div>
                        <div p-card__fotter>
                                <a href="{{ route('idea.content', [$idea->idea_id]) }}" >詳細を見る</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- ページャー  -->
    <div class="c-pager">
        {{ $ideas->links() }}
    </div>
@endsection