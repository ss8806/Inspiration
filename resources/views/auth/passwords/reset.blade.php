@extends('layouts.app')

@section('title')
    パスワードリセット
@endsection

@section('content')
<main class="l-main l-main__base">
    <div class="p-card--scaff">
            <div class="p-card">
                <div class="p-card__header">{{ __('Reset Password') }}</div>

                <div class="p-card__body">
                    <form method="POST" class="p-form" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="p-form__group">
                            <label for="email" >メールアドレス</label>
                            <div class="c-input">
                                <input id="email" type="email" class="c-input__profile @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <div class="c-error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="p-form__group">
                            <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>
                            <div class="c-input">
                                <input id="password" type="password" class="c-input__profile @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <div class="c-error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="p-form__group">
                            <label for="password-confirm" class="">パスワード（確認用）</label>
                            <div class="c-input">
                                <input id="password-confirm" type="password" class="c-input__profile" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="p-form__group">
                            <button type="submit" class="c-btn">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
