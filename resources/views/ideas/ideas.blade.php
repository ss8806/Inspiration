@extends('layouts.app')

@section('title')
    アイディア一覧
@endsection

@section('content')

    <x-serch></x-serch>

    <div class="p-card">
        <div class="c-flexbox--index">
            <div class="c-flexbox__flexcontainer c-flexbox__flexcontainer--index">
                @foreach ($ideas as $idea)
                    <div class="c-flexbox__flexitem c-flexbox__flexitem--index">
                        <div class="p-card p-card__header--index u-overflow">{{$idea->name}}</div>
                        <div class="p-card__body">
                            <table class="p-table p-table--index">
                                <td class="c_category">{{$idea->Category->name}}</td>
                            </table>
                            <table class="p-table p-table--index u-border__none--top">                    
                                <td class="u-overflow"><p>概要</p>{{ $idea->description }}</td>
                            </table>
                            <table class="p-table p-table--index u-border__none--top">
                                <td><p>投稿日</p> {{ date('Y年m月d日', strtotime($idea->updated_at)) }}</td> 
                            </table>
                            <table class="p-table p-table--index u-border__none--top">
                                <td>{{number_format($idea->price)}}円</td>
                            </table>
                            <table class="p-table p-table--index u-border__none--top">
                                <td>口コミ数 {{ $idea->count_rate }}</td>   
                            </table>
                            <table class="p-table p-table--index u-border__none--top">                    
                                <td>平均評価 {{ number_format($idea->avg_rate,1) }}点</td>
                            </table>
                            <div class="c-link--detail">
                                <a href="{{ route('idea', [$idea->id]) }}">詳細をみる</a>
                            </div>
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