<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
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
     * @param string $flag ページネーション機能を停止するかどうか
     * @return LengthAwarePaginator|Collection
     */
    public function searchContacts(array $search, string $flag = ''): LengthAwarePaginator|Collection;

    /**
     * 問い合わせ削除
     * @param Contact $contact
     * @return void
     */
    public function deleteContact(Contact $contact): void;

    /**
     * ファイルをCSVに変換するためのデータ加工
     * @param Collection $contactList 検索条件に合致した問い合わせ内容
     * @param array $genderList 性別一覧
     * @return array
     */
    public function processForCSV(Collection $contactList, array $genderList): array;
}