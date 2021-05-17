@extends('layouts.icon')

@section('title')
    プロフィール編集
@endsection

@section('content')
<main class="l-main l-main__base">
    <div class="p-card--scaff">

        <div class="c-session">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
        </div>

        <div class="p-card p-card__header">アイコン画像を編集</div>

        <div class="p-card p-card__body">
            <form method="POST" action="{{ route('mypage.edit-icon') }}" class="p-form" enctype="multipart/form-data">
                @csrf
                <div class="p-form__group">          
                    {{-- アイコン画像 --}}
                    <span class="js-image-picker">
                        <input type="file" name="avatar" class="u-display--none" accept="image/png,image/jpeg,image/gif" id="avatar" />
                        <label for="avatar">
                            @if (!empty($user->avatar_file_name))
                               <img src="https://backend0622.s3-ap-northeast-1.amazonaws.com/{{$user->avatar_file_name}}" class="c-avatar__edit">
                                <!-- <img src="/storage/avatars/{{$user->avatar_file_name}}" class="c-avatar__edit"> -->
                            @else
                                <img src="/images/avatar-default.svg" class="c-avatar__edit">
                            @endif
                        </label>
                    </span>
                    <p>アイコンをクリックして画像を選択</p>
                    <button type="submit" class="c-btn">変更を保存</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection