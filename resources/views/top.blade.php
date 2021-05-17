@extends('layouts.top')

@section('title')
    TOP
@endsection

@section('content')
<main class="l-main l-main__base">
    <div class="p-card--top">
        <div class="p-card__header">
            <div class="c-title__top">Inspiration</div>
            <p style="font-size: 18px;">アカウント一つでアイデアを<span class="u-br">売ることも買うこともできる</p>
        </div>

        <div class="p-card__body">
            <div class="c-link">
                <a href="{{route('register')}}" class="c-link__signup">新規会員登録</a>
            </div>

            <p>既に会員の方はこちら</p>

            <div class="c-link">
                    <a href="{{route('login')}}" class="c-link__login">ログイン</a>
            </div>
        </div>
    </div>
</main>
@endsection