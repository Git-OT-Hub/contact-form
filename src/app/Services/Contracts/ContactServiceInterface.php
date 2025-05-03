<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Collection;

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
}