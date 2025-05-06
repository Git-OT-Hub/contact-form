<?php

namespace App\Repositories\Implementations;

use App\Repositories\Contracts\ContactRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Category;
use App\Models\Contact;

class ContactRepository implements ContactRepositoryInterface
{
    /**
     * カテゴリ一覧を取得
     * @return Collection
     */
    public function findAllCategories(): Collection
    {
        return Category::all();
    }

    /**
     * 問い合わせ内容をDBへ登録
     * @param array $contact 問い合わせ内容
     * @return void
     */
    public function create(array $contact): void
    {
        $allTel = $contact['tel_first'] . $contact['tel_second'] . $contact['tel_third'];

        $processedContact = [
            'last_name' => $contact['last_name'],
            'first_name' => $contact['first_name'],
            'gender' => $contact['gender'],
            'email' => $contact['email'],
            'tel' => $allTel,
            'address' => $contact['address'],
            'building' => $contact['building'],
            'category_id' => $contact['category_id'],
            'detail' => $contact['detail']
        ];

        Contact::create($processedContact);
    }

    /**
     * 問い合わせ一覧を取得
     * @return LengthAwarePaginator
     */
    public function findAllContacts(): LengthAwarePaginator
    {
        return Contact::with('category')->paginate(7);
    }

    /**
     * 問い合わせに対する検索結果を取得
     * @param array $search 検索内容
     * @param string $flag ページネーション機能を停止するかどうか
     * @return LengthAwarePaginator|Collection
     */
    public function searchContacts(array $search, string $flag = ''): LengthAwarePaginator|Collection
    {
        if ($flag === 'paginate_none') {
            return Contact::with('category')->KeywordSearch((string)$search['keyword'] ?? '')
                                            ->GenderSearch((string)$search['gender'] ?? '')
                                            ->CategorySearch((string)$search['category_id'] ?? '')
                                            ->DateSearch((string)$search['created_at'] ?? '')
                                            ->get();
        }

        return Contact::with('category')->KeywordSearch((string)$search['keyword'] ?? '')
                                        ->GenderSearch((string)$search['gender'] ?? '')
                                        ->CategorySearch((string)$search['category_id'] ?? '')
                                        ->DateSearch((string)$search['created_at'] ?? '')
                                        ->paginate(7)
                                        ->withQueryString();
    }

    /**
     * 問い合わせ削除
     * @param Contact $contact
     * @return void
     */
    public function delete(Contact $contact): void
    {
        $contact->delete();
    }
}