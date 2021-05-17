@extends('layouts.app')

@section('title')
    {{$idea->name}} | アイディア購入
@endsection

@section('content')
    <div class="p-card p-card--product">
         <div class="c-session">
            @if (session('message'))
                <div class="c-session" role="alert">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <div class="p-card__header u-overflow">{{$idea->name}}</div>

            @include('ideas.idea_detail_panel', ['idea' => $idea])
        <div class="p-card__body">

            <form class="p-form" method="POST" action="{{route('idea.buy', [$idea->id])}}">
                @csrf
                <p>購入されますか</p>
                <button class="c-btn c-btn__confirm">確定</button>                
            </form>
        </div>
    </div>

@endsection