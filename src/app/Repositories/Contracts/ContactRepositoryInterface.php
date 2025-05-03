<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ContactRepositoryInterface
{
    /**
     * カテゴリ一覧を取得
     * @return Collection
     */
    public function findAllCategories(): Collection;

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
    public function findAllContacts(): LengthAwarePaginator;
}