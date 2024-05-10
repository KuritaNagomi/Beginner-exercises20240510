<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
</head>
<body>
    <header class="header">
        <h1 class="header-ttl">
            <a href="/">Atte</a>
        </h1>
        <nav class="header-nav">
            <ul class="header-nav-list">
                @if (Auth::check())
                <li class="header-nav-item"><a href="/">ホーム</a></li>
                <li class="header-nav-item">
                    <form class="form" action="/date" method="get">
                    @csrf
                        <button class="header-nav__button">日付一覧</button>
                    </form>
                </li>
                <li class="header-nav-item">
                    <form class="form" action="/user" method="get">
                    @csrf
                        <button class="header-nav__button">社員一覧</button>
                    </form>
                </li>
                <li class="header-nav-item">
                    <form class="form" action="/logout" method="post">
                    @csrf
                        <button class="header-nav__button">ログアウト</button>
                    </form>
                </li>
                @endif
            </ul>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer class="footer">
        <small>Atte, inc.</small>
    </footer>
</body>
</html>