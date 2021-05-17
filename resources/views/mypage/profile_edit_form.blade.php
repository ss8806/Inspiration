@extends('layouts.app')

@section('title')
    プロフィール編集
@endsection

@section('content')
    <div class="p-card--scaff">
        <div class="c-session">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
        </div>
            <div class="p-card p-card__header">プロフィール編集</div>
                @csrf
            <div class="p-card p-card__body">
                {{-- アイコン画像 --}}
                <span class="c-avatar">
                    <label for="avatar" class="d-inline-block">
                        @if (!empty($user->avatar_file_name))
                        <img src="https://backend0622.s3-ap-northeast-1.amazonaws.com/{{$user->avatar_file_name}}" class="c-avatar__edit">
                            <!-- local用 <img src="/storage/avatars/{{$user->avatar_file_name}}" class="c-avatar__edit"> -->
                        @else
                            <img src="/images/avatar-default.svg" class="c-avatar__edit">
                        @endif
                    </label>
                    <div>
                    <button id="avatar" class="c-btn" type=“button” onclick="location.href='edit-icon'">アイコン画像を編集</button>
                    </div>
                </span>

                {{-- ニックネーム --}}
                <div class="p-form p-form__group">
                    <label for="name">ニックネーム:</label>
                    <span class="u-br"><!-- レスポンシブで改行 --> 
                    {{$user->name}}
                    <span class="u-br"><!-- レスポンシブで改行 --> 
                    <button id="name" class="c-btn" type=“button” onclick="location.href='edit-name'">編集</button>
                </div>

                {{-- email --}}
                <div class="p-form p-form__group">
                    <label for="name">メールアドレス:</label>
                    <span class="u-br"><!-- レスポンシブで改行 --> 
                    {{$user->email}}
                    <span class="u-br"><!-- レスポンシブで改行 --> 
                    <button id="name" class="c-btn" type=“button” onclick="location.href='edit-email'">編集</button>
                </div>

                {{-- password --}}
                <div class="p-form p-form__group">
                    <label for="password">パスワード:</label>
                    <span class="u-br"><!-- レスポンシブで改行 --> 
                    <button class="c-btn" type=“button” onclick="location.href='edit-password'">編集</button>
                </div>
            </div>
        </div>
        

@endsection