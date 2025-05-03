@extends('layouts.app')

@section('title', 'お問い合わせ入力画面')

@section('vite')
    @vite(['resources/css/individual/contacts/create.css'])
@endsection

@section('content')
    <div class="contact-form__content">
        <div class="contact-form__heading">
            <h2>Contact</h2>
        </div>

        <form method="POST" action="{{ route('contacts.confirm') }}" class="form">
            @csrf

            <table class="form__table">
                <tr class="form__table-group">
                    <td class="form__table-title">
                        <label for="name">
                            お名前 <span>※</span>
                        </label>
                    </td>
                    <td class="form__table-content">
                        <div class="form__name">
                            <div class="form__last-name">
                                <div class="form__table-input">
                                    <input id="name" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例: 山田" autofocus>
                                </div>
                            </div>
                            <div class="form__name-space"></div>
                            <div class="form__first-name">
                                <div class="form__table-input">
                                    <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例: 太郎">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="form__table-error">
                    <td class="form__table-error--head"></td>
                    <td class="form__table-error--body">
                        <div class="form__error-content">
                            <div class="form__error-content--name">
                                @error('last_name')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form__error-content--space"></div>
                            <div class="form__error-content--name">
                                @error('first_name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </td>
                </tr>

                <tr class="form__table-group">
                    <td class="form__table-title">
                        <label>
                            性別 <span>※</span>
                        </label>
                    </td>
                    <td class="form__table-content">
                        <div class="form__table-input--radio">
                            @foreach($genderList as $gender)
                                @if($gender->label() === '男性')
                                    <label>
                                        <input type="radio" name="gender" value="{{ $gender->value }}" {{ (string)old('gender', $gender->value) === (string)$gender->value ? 'checked' : '' }}>
                                        <span>{{ $gender->label() }}</span>
                                    </label>
                                @else
                                    <label>
                                        <input type="radio" name="gender" value="{{ $gender->value }}" {{ (string)old('gender') === (string)$gender->value ? 'checked' : '' }}>
                                        <span>{{ $gender->label() }}</span>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr class="form__table-error">
                    <td class="form__table-error--head"></td>
                    <td class="form__table-error--body">
                        @error('gender')
                            {{ $message }}
                        @enderror
                    </td>
                </tr>

                <tr class="form__table-group">
                    <td class="form__table-title">
                        <label for="email">
                            メールアドレス <span>※</span>
                        </label>
                    </td>
                    <td class="form__table-content">
                        <div class="form__table-input">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                        </div>
                    </td>
                </tr>
                <tr class="form__table-error">
                    <td class="form__table-error--head"></td>
                    <td class="form__table-error--body">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </td>
                </tr>

                <tr class="form__table-group">
                    <td class="form__table-title">
                        <label for="tel">
                            電話番号 <span>※</span>
                        </label>
                    </td>
                    <td class="form__table-content">
                        <div class="form__tel">
                            <div class="form__tel-first">
                                <div class="form__table-input">
                                    <input id="tel" type="tel" name="tel_first" value="{{ old('tel_first') }}" placeholder="例:080">
                                </div>
                            </div>
                            <div class="form__bar">
                                <span>-</span>
                            </div>
                            <div class="form__tel-second">
                                <div class="form__table-input">
                                    <input type="tel" name="tel_second" value="{{ old('tel_second') }}" placeholder="例:1234">
                                </div>
                            </div>
                            <div class="form__bar">
                                <span>-</span>
                            </div>
                            <div class="form__tel-third">
                                <div class="form__table-input">
                                    <input type="tel" name="tel_third" value="{{ old('tel_third') }}" placeholder="例:5678">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="form__table-error">
                    <td class="form__table-error--head"></td>
                    <td class="form__table-error--body">
                        <div class="form__error-content">
                            <div class="form__error-content--tel">
                                @error('tel_first')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form__error-content--space"></div>
                            <div class="form__error-content--tel">
                                @error('tel_second')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form__error-content--space"></div>
                            <div class="form__error-content--tel">
                                @error('tel_third')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </td>
                </tr>

                <tr class="form__table-group">
                    <td class="form__table-title">
                        <label for="address">
                            住所 <span>※</span>
                        </label>
                    </td>
                    <td class="form__table-content">
                        <div class="form__table-input">
                            <input id="address" type="text" name="address" value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
                        </div>
                    </td>
                </tr>
                <tr class="form__table-error">
                    <td class="form__table-error--head"></td>
                    <td class="form__table-error--body">
                        @error('address')
                            {{ $message }}
                        @enderror
                    </td>
                </tr>

                <tr class="form__table-group">
                    <td class="form__table-title">
                        <label for="building">
                            建物名
                        </label>
                    </td>
                    <td class="form__table-content">
                        <div class="form__table-input">
                            <input id="building" type="text" name="building" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101">
                        </div>
                    </td>
                </tr>
                <tr class="form__table-error">
                    <td class="form__table-error--head"></td>
                    <td class="form__table-error--body">
                        @error('building')
                            {{ $message }}
                        @enderror
                    </td>
                </tr>

                <tr class="form__table-group">
                    <td class="form__table-title">
                        <label for="category_id">
                            お問い合わせの種類 <span>※</span>
                        </label>
                    </td>
                    <td class="form__table-content">
                        <div class="form__table-select">
                            <select name="category_id" id="category_id">
                                <option value="">選択してください</option>
                                @foreach($categoryList as $category)
                                    <option value="{{ $category['id'] }}" {{ (string)old('category_id') === (string)$category['id'] ? 'selected' : '' }}>{{ $category['content'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                </tr>
                <tr class="form__table-error">
                    <td class="form__table-error--head"></td>
                    <td class="form__table-error--body">
                        @error('category_id')
                            {{ $message }}
                        @enderror
                    </td>
                </tr>

                <tr class="form__table-group--detail">
                    <td class="form__table-title">
                        <label for="detail">
                            お問い合わせ内容 <span>※</span>
                        </label>
                    </td>
                    <td class="form__table-content">
                        <div class="form__table-textarea">
                            <textarea name="detail" id="detail" rows="6" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                        </div>
                    </td>
                </tr>
                <tr class="form__table-error">
                    <td class="form__table-error--head"></td>
                    <td class="form__table-error--body">
                        @error('detail')
                            {{ $message }}
                        @enderror
                    </td>
                </tr>
            </table>

            <div class="form__confirm-button">
                <button class="form__confirm-button--submit" type="submit">確認画面</button>
            </div>
        </form>
    </div>
@endsection
