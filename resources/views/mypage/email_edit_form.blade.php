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

        <div class="p-card p-card__header">メールアドレスを編集</div>
        <div class="p-card p-card__body">
            <form method="POST" action="{{ route('mypage.edit-email') }}" class="p-form" enctype="multipart/form-data">
                @csrf          
                    {{-- メールアドレス --}}
                    <div class="p-form p-form__group">
                        <label for="email">メールアドレス</label>
                        <input id="email" type="text" class="c-input__profile @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email" autofocus>
                        @error('email')
                            <div class="c-error" role="alert">
                            <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="c-btn">変更を保存</button>
            </form>
        </div>
    </div>
@endsection