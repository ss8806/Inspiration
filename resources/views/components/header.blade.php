<header class="l-header l-header__base">
    <nav class="p-nav">

        <div class="p-nav--left">
            <a  href="{{ url('ideas/index') }}">
                <div class="c-title__main">Inspiration</div>
            </a>
        </div>

        <div class="p-nav p-nav--right"> 
            <ul class="p-nav p-nav__menu">
                <li><a class="p-nav__menu--name">
                @guest
                    {{-- ログインしてない場合は何も表示しない --}}
                @else
                    {{-- ヘッダーにナビを表示 --}}
                    </a></li>
                    <li>
                        @if (!empty($user->avatar_file_name))
                            <img src="https://backend0622.s3-ap-northeast-1.amazonaws.com/{{$user->avatar_file_name}}" class="c-avatar">
                        @else
                            <img src="/images/avatar-default.svg" class="c-avatar">
                        @endif
                    </li>
                    <li>ようこそ {{ $user->name }}様</li>
                    <li><a class="p-nav__menu" href="{{ route('mypage.mypage') }}">マイページ</a></li>
                    <li><a class="p-nav__menu" href="{{ route('sell') }}">アイディアを投稿する</a></li>
                    <li><a class="p-nav__menu" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        ログアウト
                        </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                    </li>
                @endguest
            </ul>

            {{-- ドロップダウンメニュー（レスポンシブ用） --}}
            <div class="p-nav p-nav__dropdown">
                @guest
                   {{-- ログインしてないなら何も表示しない --}}
                @else
                <ul class="c-dropdown">
                {{-- ログイン済み --}}
                    {{-- ログイン情報 --}}
                    <li><a class="c-dropdown"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if (!empty($user->avatar_file_name))
                            <img src="https://backend0622.s3-ap-northeast-1.amazonaws.com/{{$user->avatar_file_name}}" class="c-avatar">
                            <!-- <img src="/storage/avatars/{{$user->avatar_file_name}}" class="c-avatar"> -->
                        @else
                            <img src="/images/avatar-default.svg" class="c-avatar">
                        @endif
                            {{ $user->name }} <span class="caret" ></span>
                        </a>
                        {{-- ドロップダウンメニュー --}}
                            <ul>
                            <li><a class="c-dropdown" href="{{ route('mypage.mypage') }}"></i>マイページ</a></li>
                            <li><a class="c-dropdown" href="{{ route('sell') }}">アイディアを投稿する</a></li>
                            <li><a class="c-dropdown" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                ログアウト
                                </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </li>
                            </ul>
                        @endguest
                    </li>
                </ul>
            </div>
        </div>
    </nav>  
</header>