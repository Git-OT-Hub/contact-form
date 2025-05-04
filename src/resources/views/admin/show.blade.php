<div id="admin-contact_{{ $contact['id'] }}" class="admin-contacts__show hidden">
    <div class="admin-contacts__show-delete">
        <button class="contact__show-delete--button" value="{{ $contact['id'] }}">×</button>
    </div>
    <table class="form__table">
        <tr class="form__table-group">
            <td class="form__table-title">
                お名前
            </td>
            <td class="form__table-content">
                {{ "{$contact['last_name']} {$contact['first_name']}" }}
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
            </td>
        </tr>

        <tr class="form__table-group">
            <td class="form__table-title">
                メールアドレス
            </td>
            <td class="form__table-content">
                {{ $contact['email'] }}
            </td>
        </tr>

        <tr class="form__table-group">
            <td class="form__table-title">
                電話番号
            </td>
            <td class="form__table-content">
                {{ $contact['tel'] }}
            </td>
        </tr>

        <tr class="form__table-group">
            <td class="form__table-title">
                住所
            </td>
            <td class="form__table-content">
                {{ $contact['address'] }}
            </td>
        </tr>

        <tr class="form__table-group">
            <td class="form__table-title">
                建物名
            </td>
            <td class="form__table-content">
                {{ $contact['building'] }}
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
            </td>
        </tr>

        <tr class="form__table-group">
            <td class="form__table-title">
                お問い合わせ内容
            </td>
            <td class="form__table-content">
                {!! nl2br(e($contact['detail'])) !!}
            </td>
        </tr>
    </table>
    <div class="form__table-button">
        <form method="POST" action="{{ route('admin.delete', $contact) }}">
            @method("DELETE")
            @csrf

            <button type="submit">削除</button>
        </form>
    </div>
</div>
