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
                <a href="{{ route('contacts.create') }}" class="header__logo">
                    FashionablyLate
                </a>
            </div>
        </div>
    </header>
    <div class="flash-message">
        @if(session('successMessage'))
            <div class="flash-message__success">
                {{ session('successMessage') }}
            </div>
        @elseif(session('failureMessage'))
            <div class="flash-message__danger">
                {{ session('failureMessage') }}
            </div>
        @endif
    </div>

    <main>
        @yield('content')
    </main>
</body>
</html>
