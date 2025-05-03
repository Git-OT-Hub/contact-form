@extends('layouts.admin')

@section('title', 'ログインページ')

@section('vite')
    @vite(['resources/css/admin/individual/login.css'])
@endsection

@section('link')
    <a href="{{ route('register') }}" class="header-nav__link">register</a>
@endsection

@section('content')
    <div class="register-form__content">
        <div class="register-form__heading">
            <h2>Login</h2>
        </div>

        <form method="POST" action="{{ route('login.store') }}" class="form">
            @csrf

            <div class="form__group">
                <div class="form__group-title">
                    <label for="email" class="form__group-label">メールアドレス</label>
                </div>
                <div class="form__group-content">
                    <div class="form__error">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="form__input--text">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="例:test@example.com" autofocus>
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <label for="password" class="form__group-label">パスワード</label>
                </div>
                <div class="form__group-content">
                    <div class="form__error">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="form__input--text">
                        <input id="password" type="password" name="password" value="{{ old('password') }}" placeholder="例:coachtech1106">
                    </div>
                </div>
            </div>

            <div class="form__button">
                <button class="form__button-submit" type="submit">ログイン</button>
            </div>
        </form>
    </div>
@endsection