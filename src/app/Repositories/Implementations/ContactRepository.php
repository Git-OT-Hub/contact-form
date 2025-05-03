<?php

namespace App\Repositories\Implementations;

use App\Repositories\Contracts\ContactRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Category;

class ContactRepository implements ContactRepositoryInterface
{
    /**
     * カテゴリ一覧を取得
     * @return Collection
     */
    public function findAll(): Collection
    {
        return Category::all();
    }
}