<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles, Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('vite')
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <span class="header__span"></span>
                <a href="" class="header__logo">
                    FashionablyLate
                </a>
                <nav class="header-nav">
                    @if (Auth::check())
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button class="header-nav__button">logout</button>
                        </form>
                    @else
                        @yield('link')
                    @endif
                </nav>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>