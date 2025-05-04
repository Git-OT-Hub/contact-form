<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Contact;

interface ContactServiceInterface
{
    /**
     * 性別一覧を取得
     * @return array
     */
    public function getGenderList(): array;

    /**
     * カテゴリ一覧を取得
     * @return Collection
     */
    public function getCategoryList(): Collection;

    /**
     * 問い合わせ内容をDBへ登録
     * @param array $contact 問い合わせ内容
     * @return void
     */
    public function create(array $contact): void;

    /**
     * 問い合わせ一覧を取得
     * @return LengthAwarePaginator
     */
    public function getContactList(): LengthAwarePaginator;

    /**
     * 問い合わせに対する検索結果を取得
     * @param array $search 検索内容
     * @return LengthAwarePaginator
     */
    public function searchContacts(array $search): LengthAwarePaginator;

    /**
     * 問い合わせ削除
     * @param Contact $contact
     * @return void
     */
    public function deleteContact(Contact $contact): void;
}