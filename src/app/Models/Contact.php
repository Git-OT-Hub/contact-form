<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use App\Enums\Gender;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    /**
     * この問い合わせを所有しているカテゴリーの取得
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 「姓」または「名」または「メール」に合致するデータを取得
     * @param Builder $query
     * @param string $keyword 「姓」または「名」または「メール」
     * @return Builder
     */
    public function scopeKeywordSearch(Builder $query, string $keyword): Builder
    {
        $replaceKeyword = str_replace(["　", " "], "", $keyword);
        if (!empty($replaceKeyword)) {
            return $query->where(function ($q) use ($replaceKeyword) {
                $q->where(DB::raw('CONCAT(last_name, first_name)'), 'like', "%{$replaceKeyword}%")
                ->orWhere('email', 'like', "%{$replaceKeyword}%");
            });
        }

        return $query;
    }

    /**
     * 「性」に合致するデータを取得
     * @param Builder $query
     * @param string $gender 「性」
     * @return Builder
     */
    public function scopeGenderSearch(Builder $query, string $gender): Builder
    {
        if (!empty($gender) && $gender === 'all') {
            return $query->where('gender', '=', '1')
                         ->orWhere('gender', '=', '2')
                         ->orWhere('gender', '=', '3');
        } else if (!empty($gender)) {
            return $query->where('gender', '=', $gender);
        }

        return $query;
    }

    /**
     * 「問い合わせの種類」に合致するデータを取得
     * @param Builder $query
     * @param string $category_id 「カテゴリーID」
     * @return Builder
     */
    public function scopeCategorySearch(Builder $query, string $category_id): Builder
    {
        if (!empty($category_id)) {
            return $query->where('category_id', '=', $category_id);
        }

        return $query;
    }

    /**
     * 「問い合わせ作成日」に合致するデータを取得
     * @param Builder $query
     * @param string $created_at 「日付」
     * @return Builder
     */
    public function scopeDateSearch(Builder $query, string $created_at): Builder
    {
        if (!empty($created_at)) {
            return $query->whereDate('created_at', '=', $created_at);
        }

        return $query;
    }
}
