@extends('layouts.app')

@section('title')
    ログイン
@endsection

@section('content')
<main class="l-main l-main__base">
    <div class="p-card--scaff">
        <div class="p-card p-card__header">
            <p>ログイン</p>
        </div>

        <div class="p-card__body">
            <div class="p-form">
                <form method="POST" action="{{ route('login') }}" class="p-form">
                    @csrf
                    <div class="p-form__group">
                        <label for="email" class="c-label">メールアドレス</label>
                        <div class="c-input">
                            <input id="email" type="email" class="c-input__profile @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                        @error('email')
                            <div class="c-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="p-form__group">
                        <label for="password" class="c-label">パスワード</label>
                        <div class=c-input>
                            <input id="password" type="password" class="c-input__profile @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        </div>
                        @error('password')         
                        <div class="c-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror

                    <div class="p-card__form--group">
                        <div class="c-form-check">
                            <input class="c-form-check__input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="c-form-check__label" for="remember">
                                ログイン状態を保存する
                            </label>
                        </div>
                    </div>

                    <div class="p-card__form--group">
                        <button type="submit" class="c-btn">
                            ログイン
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>

        <div class="p-card__footer">
                <div class="c-link__signup">
                    <p>アカウントをお持ちでない方は</p>
                    <a href="{{ route('register') }}">こちら</a>
                </div>
                <div class="c-link__login">
                    <p>パスワードをお忘れの方は</p>
                    <a href="{{ route('password.request') }}">こちら</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
