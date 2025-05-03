<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface ContactRepositoryInterface
{
    /**
     * カテゴリ一覧を取得
     * @return Collection
     */
    public function findAll(): Collection;
}