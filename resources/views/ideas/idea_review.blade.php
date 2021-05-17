@extends('layouts.app')

@section('title')
    {{$idea->name}} | アイディアレビュー
@endsection

@section('content')
    <div class="p-card p-card--product">
        <div class="p-card__header">{{$idea->name}}のレビュー</div>

        <div class="p-card__body">
            <table class="p-table p-table--review" >
                        <tr class="p-table__border">
                            <th class="p-table__border p-table__ws">評価</th>
                            <td class="p-table__cell">コメント</td>
                        </tr>
            </table>
            @foreach ($trades as $trade)
                @if($idea->id === $trade->idea_id)
                    <table class="p-table p-table--review u-border__none--top">
                        <tr class="p-table__border u-border__none--top">
                            <th class="p-table__border p-table__ws u-border__none--top">{{$trade->rates}}</th>
                            <td class="p-table__left">{{$trade->comment}}</td>
                        </tr>
                    </table>
                @endif
            @endforeach
        </div>

         <!-- ページャー  -->
         <div class="c-pager">
            {{ $trades->links() }}
        </div>
    </div>


@endsection