<?php

namespace App\Enums;

enum Gender: int
{
    case MALE = 1;
    case FEMALE = 2;
    case OTHERS = 3;

    /**
     * 性別の日本語を取得
     * @return string 性別
     */
    public function label(): string
    {
        return match($this)
        {
            self::MALE => '男性',
            self::FEMALE => '女性',
            self::OTHERS => 'その他',
        };
    }
}