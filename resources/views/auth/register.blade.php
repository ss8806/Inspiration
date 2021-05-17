@extends('layouts.app')

@section('title')
    会員登録
@endsection

@section('content')
<main class="l-main l-main__base">
    <div class="p-card--scaff">
        <div class="p-card p-card__header">
            <p>会員情報登録</p>
        </div>

        <div class="p-card__body">
            <form method="POST" action="{{ route('register') }}" class="p-form">
                @csrf
                <div class="p-form__group">
                    <label for="name" class="c-label">ニックネーム</label>
                    <div class="c-input">
                        <input id="name" type="text" class="c-input__profile @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="お名前">
                    </div>
                    @error('name')
                        <div class="c-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
            
                <div class="p-form__group">
                    <label for="email">メールアドレス</label>
                    <div class="c-input">
                        <input id="email" type="email" class="c-input__profile @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレス">
                    </div>
                    @error('email')
                        <div class="c-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="p-form__group">
                    <label for="password" class="c-form__label">パスワード</label>
                    <div class="p-card__form--input">
                        <input id="password" type="password" class="c-input__profile @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="パスワード">
                    </div>
                    @error('password')
                    <div class="c-erorr" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>

                <div class="p-form__group">
                    <button type="submit" class="c-btn ">
                        会員登録
                    </button>
                </div>

            </form>
        </div>

        <div class="p-card__footer">
            <span>アカウントをお持ちの方は</span>
            <a href="{{ route('login') }}">こちら</a>
        </div>
    </div>
</main>
@endsection