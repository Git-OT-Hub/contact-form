@extends('layouts.app')

@section('title', 'お問い合わせ確認画面')

@section('vite')
    @vite(['resources/css/individual/contacts/confirm.css'])
@endsection

@section('content')
    <div class="contact-form__content">
        <div class="contact-form__heading">
            <h2>Confirm</h2>
        </div>

        <form method="POST" action="{{ route('contacts.store') }}" class="form">
            @csrf

            <table border="1" class="form__table">
                <tr class="form__table-group">
                    <td class="form__table-title">
                        お名前
                    </td>
                    <td class="form__table-content">
                        {{ "{$contact['last_name']} {$contact['first_name']}" }}
                        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                    </td>
                </tr>

                <tr class="form__table-group">
                    <td class="form__table-title">
                        性別
                    </td>
                    <td class="form__table-content">
                        @foreach($genderList as $gender)
                            @if((string)$gender->value === (string)$contact['gender'])
                                {{ $gender->label() }}
                            @endif
                        @endforeach
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                    </td>
                </tr>

                <tr class="form__table-group">
                    <td class="form__table-title">
                        メールアドレス
                    </td>
                    <td class="form__table-content">
                        {{ $contact['email'] }}
                        <input type="hidden" name="email" value="{{ $contact['email'] }}">
                    </td>
                </tr>

                <tr class="form__table-group">
                    <td class="form__table-title">
                        電話番号
                    </td>
                    <td class="form__table-content">
                        {{ "{$contact['tel_first']}{$contact['tel_second']}{$contact['tel_third']}" }}
                        <input type="hidden" name="tel_first" value="{{ $contact['tel_first'] }}">
                        <input type="hidden" name="tel_second" value="{{ $contact['tel_second'] }}">
                        <input type="hidden" name="tel_third" value="{{ $contact['tel_third'] }}">
                    </td>
                </tr>

                <tr class="form__table-group">
                    <td class="form__table-title">
                        住所
                    </td>
                    <td class="form__table-content">
                        {{ $contact['address'] }}
                        <input type="hidden" name="address" value="{{ $contact['address'] }}">
                    </td>
                </tr>

                <tr class="form__table-group">
                    <td class="form__table-title">
                        建物名
                    </td>
                    <td class="form__table-content">
                        {{ $contact['building'] }}
                        <input type="hidden" name="building" value="{{ $contact['building'] }}">
                    </td>
                </tr>

                <tr class="form__table-group">
                    <td class="form__table-title">
                        お問い合わせの種類
                    </td>
                    <td class="form__table-content">
                        @foreach($categoryList as $category)
                            @if((string)$category['id'] === (string)$contact['category_id'])
                                {{ $category['content'] }}
                            @endif
                        @endforeach
                        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                    </td>
                </tr>

                <tr class="form__table-group">
                    <td class="form__table-title">
                        お問い合わせ内容
                    </td>
                    <td class="form__table-content">
                        {!! nl2br(e($contact['detail'])) !!}
                        <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
                    </td>
                </tr>
            </table>

            <div class="form__button">
                <div class="form__button-submit">
                    <button type="submit" name="submit" value="complete">送信</button>
                </div>
                <div class="form__button-fix">
                    <button type="submit" name="submit" value="fix">修正</button>
                </div>
            </div>
        </form>
    </div>
@endsection