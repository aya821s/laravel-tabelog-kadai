<div class="header-container">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <div class="d-flex align-items-center">NAGOYAMESHI</div>
            </a>

            @guest
                <ul class="navbar-nav ms-auto">
                    @if (Route::has('login'))
                        <div class="mr-auto">
                            <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                        </div>
                    @endif

                    @if (Route::has('register'))
                        <div class="mr-auto">
                            <a class="nav-link" href="{{ route('register') }}">新規登録</a>
                        </div>
                    @endif

                    @else
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('mypage') }}">マイページ</a></li>
                            <li><a class="dropdown-item" href="{{ route('mypage.edit') }}">マイページ編集</a></li>
                            @if (Auth::user()->subscribed('premium_plan'))
                                <li><a class="dropdown-item" href="{{ route('mypage.favorite') }}">お気に入り店舗一覧</a></li>
                                <li><a class="dropdown-item" href="{{ route('reservations.index') }}">予約一覧</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('subscription.create') }}">有料プラン登録</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">ログアウト</a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </ul>
            @endguest
        </div>
    </nav>
</div>