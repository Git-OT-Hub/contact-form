<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Gender;

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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            return $query->where('first_name', 'like', "%{$keyword}%")
                         ->orWhere('last_name', 'like', "%{$keyword}%")
                         ->orWhere('email', 'like', "%{$keyword}%");
        }

        return $query;
    }

    public function scopeGenderSearch($query, $gender)
    {
        if (!empty($gender) && (string)$gender === 'all') {
            return $query->where('gender', '=', 1)
                         ->orWhere('gender', '=', 2)
                         ->orWhere('gender', '=', 3);
        } else if (!empty($gender)) {
            return $query->where('gender', '=', $gender);
        }

        return $query;
    }

    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
            return $query->where('category_id', '=', $category_id);
        }

        return $query;
    }

    public function scopeDateSearch($query, $created_at)
    {
        if (!empty($created_at)) {
            return $query->whereDate('created_at', '=', $created_at);
        }

        return $query;
    }
}
