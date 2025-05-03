<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>サンクスページ</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles, Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/individual/contacts/thanks.css'])
</head>
<body>
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
        <div class="contact-thanks">
            <div class="contact-thanks__back">
                <span>Thank you</span>
            </div>
            <div class="contact-thanks__front">
                <div class="contact-thanks__content">
                    お問い合わせありがとうございました
                </div>
                <div class="contact-thanks__button">
                    <a href="{{ route('contacts.create') }}">HOME</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
