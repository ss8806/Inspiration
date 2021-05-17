@extends('layouts.app')

@section('title')
    パスワードリセット
@endsection

@section('content')
<main class="l-main l-main__base">
    <div class="p-card--scaff">
        <div class="p-card__header">
            <p>パスワードをお忘れの方</p>
        </div>

        <div class="p-card__body">
            <form method="POST" action="{{ route('password.email') }}" class="p-card__form">
                @csrf
                <div class="c-form c-form__group">
                    <label for="email" class="c-label">メールアドレス</label>
                    <div class="c-form">
                        <input id="email" type="email" class="c-input__profile @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="test@example.com">
                    </div>
                    @error('email')
                        <div class="c-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="p-form__group">
                    <button type="submit" class="c-btn ">
                        送信する
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
