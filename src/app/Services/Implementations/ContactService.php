<?php

namespace App\Services\Implementations;

use App\Services\Contracts\ContactServiceInterface;
use App\Repositories\Contracts\ContactRepositoryInterface;
use App\Enums\Gender;
use Illuminate\Database\Eloquent\Collection;

class ContactService implements ContactServiceInterface
{
    private ContactRepositoryInterface $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * 性別一覧を取得
     * @return array
     */
    public function getGenderList(): array
    {
        return Gender::cases();
    }

    /**
     * カテゴリ一覧を取得
     * @return Collection
     */
    public function getCategoryList(): Collection
    {
        return $this->contactRepository->findAll();
    }
}