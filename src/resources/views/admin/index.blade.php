@extends('layouts.admin')

@section('title', '管理画面')

@section('vite')
    @vite(['resources/css/admin/individual/index.css', 'resources/js/admin/individual/index.js'])
@endsection

@section('content')
    <div class="admin-contacts">
        <div class="admin-contacts__heading">
            <h2>Admin</h2>
        </div>

        <form class="search-form" method="GET" action="{{ route('admin.search') }}">
            @csrf

            <div class="search-form__item">
                <div class="search-form__item-input--text">
                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">
                </div>

                <div class="search-form__item-select--gender">
                    <select name="gender">
                        <option value="">性別</option>
                        <option value="all" {{ (string)request('gender') === 'all' ? 'selected' : '' }}>全て</option>
                        @foreach($genderList as $gender)
                            <option value="{{ $gender->value }}" {{ (string)request('gender') === (string)$gender->value ? 'selected' : '' }}>{{ $gender->label() }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="search-form__item-select--category">
                    <select name="category_id">
                        <option value="">お問い合わせの種類</option>
                        @foreach($categoryList as $category)
                            <option value="{{ $category['id'] }}" {{ (string)request('category_id') === (string)$category['id'] ? 'selected' : '' }}>{{ $category['content'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="search-form__item-input--date">
                    <input type="date" name="created_at" value="{{ request('created_at') }}">
                </div>

                <div class="search-form__button-submit">
                    <button type="submit" name="submit" value="search">検索</button>
                </div>

                <div class="search-form__button-reset">
                    <button type="submit" name="submit" value="reset">リセット</button>
                </div>
            </div>
        </form>

        <div class="admin-contacts__links">
            <div class="admin-contacts__links-export">
                <form method="POST" action="{{ route('admin.csv_download') }}">
                    @csrf

                    <button type="submit">エクスポート</button>
                </form>
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
                @forelse($contactList as $contact)
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
                            <button value="{{ $contact['id'] }}" class="contact__show-button">詳細</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            問い合わせ内容が見つかりませんでした。
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="admin-contacts__detail-item">
            <div id="cantacts_mask" class="hidden"></div>

            <div>
                @forelse($contactList as $contact)
                    @include('admin.show', ['contact' => $contact, 'genderList' => $genderList])
                @empty
                @endforelse
            </div>
        </div>
    </div>
@endsection