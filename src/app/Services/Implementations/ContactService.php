<?php

namespace App\Services\Implementations;

use App\Services\Contracts\ContactServiceInterface;
use App\Repositories\Contracts\ContactRepositoryInterface;
use App\Enums\Gender;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Contact;
use Carbon\Carbon;

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
        return $this->contactRepository->findAllCategories();
    }

    /**
     * 問い合わせ内容をDBへ登録
     * @param array $contact 問い合わせ内容
     * @return void
     */
    public function create(array $contact): void
    {
        $this->contactRepository->create($contact);
    }

    /**
     * 問い合わせ一覧を取得
     * @return LengthAwarePaginator
     */
    public function getContactList(): LengthAwarePaginator
    {
        return $this->contactRepository->findAllContacts();
    }

    /**
     * 問い合わせに対する検索結果を取得
     * @param array $search 検索内容
     * @param string $flag ページネーション機能を停止するかどうか
     * @return LengthAwarePaginator|Collection
     */
    public function searchContacts(array $search, string $flag = ''): LengthAwarePaginator|Collection
    {
        return $this->contactRepository->searchContacts($search, $flag);
    }

    /**
     * 問い合わせ削除
     * @param Contact $contact
     * @return void
     */
    public function deleteContact(Contact $contact): void
    {
        $this->contactRepository->delete($contact);
    }

    /**
     * ファイルをCSVに変換するためのデータ加工
     * @param Collection $contactList 検索条件に合致した問い合わせ内容
     * @param array $genderList 性別一覧
     * @return array
     */
    public function processForCSV(Collection $contactList, array $genderList): array
    {
        $temps = [];
        $csvHeader = [
            'ID', 'お問い合わせの種類', '名', '姓', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせ内容', '作成日時'
        ];

        array_push($temps, $csvHeader);

        foreach ($contactList as $contact) {
            $temp = [];
            $gender = '';

            foreach ($genderList as $item) {
                if ((string)$contact['gender'] === (string)$item->value) {
                    $gender = $item->label();
                }
            }

            $temp = [
                $contact['id'],
                $contact['category']['content'],
                $contact['first_name'],
                $contact['last_name'],
                $gender,
                $contact['email'],
                $contact['tel'],
                $contact['address'],
                $contact['building'],
                $contact['detail'],
                $contact['created_at']->format('Y-m-d H:i:s'),
            ];

            array_push($temps, $temp);
        }

        $stream = fopen('php://temp', 'r+b');
        foreach ($temps as $temp) {
            fputcsv($stream, $temp);
        }

        rewind($stream);
        $csv = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));
        $csv = mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');

        fclose($stream);

        $now = Carbon::now()->format('Y-m-d_H:i:s');
        $fileName = "お問い合わせ一覧_" . $now . ".csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ];

        return [
            'csv' => $csv,
            'headers' => $headers
        ];
    }
}