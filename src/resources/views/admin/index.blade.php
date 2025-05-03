@extends('layouts.admin')

@section('title', '管理画面')

@section('vite')
    @vite(['resources/css/admin/individual/index.css'])
@endsection

@section('content')
    <div class="admin-contacts">
        <div class="admin-contacts__heading">
            <h2>Admin</h2>
        </div>

        <form class="search-form" method="" action="">
            @csrf

            <div class="search-form__item">
                <div class="search-form__item-input--text">
                    <input type="text" name="name_email" value="{{ old('name_email') }}" placeholder="名前やメールアドレスを入力してください">
                </div>

                <div class="search-form__item-select--gender">
                    <select name="gender">
                        <option value="">性別</option>
                        <option value="all">全て</option>
                        @foreach($genderList as $gender)
                            <option value="{{ $gender->value }}" {{ (string)old('gender') === (string)$gender->value ? 'selected' : '' }}>{{ $gender->label() }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="search-form__item-select--category">
                    <select name="category_id">
                        <option value="">お問い合わせの種類</option>
                        @foreach($categoryList as $category)
                            <option value="{{ $category['id'] }}" {{ (string)old('category_id') === (string)$category['id'] ? 'selected' : '' }}>{{ $category['content'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="search-form__item-input--date">
                    <input type="date" name="created_at" value="{{ old('created_at') }}">
                </div>

                <div class="search-form__button-submit">
                    <button type="submit">検索</button>
                </div>

                <div class="search-form__button-reset">
                    <button type="submit">リセット</button>
                </div>
            </div>
        </form>

        <div class="admin-contacts__links">
            <div class="admin-contacts__links-export">
                <button>エクスポート</button>
            </div>
            <div class="admin-contacts__links-pagination">
                {{ $contactList->links('pagination::default') }}
            </div>
        </div>
        <table class="contacts-table">
            <thead class="contacts-table__heading">
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="contacts-table__body">
                @foreach($contactList as $contact)
                    <tr>
                        <td>
                            {{ "{$contact['last_name']} {$contact['first_name']}" }}
                        </td>
                        <td>
                            @foreach($genderList as $gender)
                                @if((string)$gender->value === (string)$contact['gender'])
                                    {{ $gender->label() }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            {{ $contact['email'] }}
                        </td>
                        <td>
                            {{ $contact['category']['content'] }}
                        </td>
                        <td>
                            <button id="{{ $contact['id'] }}">詳細</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection