@extends('layouts.admin')

@section('title', 'ユーザー登録ページ')

@section('vite')
    @vite(['resources/css/individual/register.css'])
@endsection

@section('link')
    <a href="{{ route('login') }}" class="header-nav__link">login</a>
@endsection

@section('content')
    <div class="register-form__content">
        <div class="register-form__heading">
            <h2>Register</h2>
        </div>

        <form method="POST" action="{{ route('register.store') }}" class="form">
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <label for="name" class="form__group-label">お名前</label>
                </div>
                <div class="form__group-content">
                    <div class="form__error">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="form__input--text">
                        <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="例:山田 太郎" autofocus>
                    </div>
                </div>
            </div>

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
                        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="例:test@example.com">
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
                <button class="form__button-submit" type="submit">登録</button>
            </div>
        </form>
    </div>
@endsection