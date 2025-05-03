<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'tel_first' => ['required', 'string', 'max:5', 'regex:/^[0-9]+$/'],
            'tel_second' => ['required', 'string', 'max:5', 'regex:/^[0-9]+$/'],
            'tel_third' => ['required', 'string', 'max:5', 'regex:/^[0-9]+$/'],
            'address' => ['required', 'string', 'max:255'],
            'building' => ['max:255'],
            'category_id' => ['required', 'integer'],
            'detail' => ['required', 'string', 'max:120'],
        ];
    }

    /**
     * バリデーションの日本語化
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'last_name.required' => '姓を入力してください',
            'last_name.string' => '姓を文字列で入力してください',
            'last_name.max' => '姓を255文字以下で入力してください',

            'first_name.required' => '名を入力してください',
            'first_name.string' => '名を文字列で入力してください',
            'first_name.max' => '名を255文字以下で入力してください',

            'gender.required' => '性別を選択してください',
            'gender.integer' => '性別を整数で入力してください',

            'email.required' => 'メールアドレスを入力してください',
            'email.string' => 'メールアドレスを文字列で入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'email.max' => 'メールアドレスを255文字以下で入力してください',

            'tel_first.required' => '電話番号を入力してください',
            'tel_first.string' => '電話番号を文字列で入力してください',
            'tel_first.max' => '電話番号は5桁までの数字で入力してください',
            'tel_first.regex' => '電話番号は半角数字のみで入力してください',

            'tel_second.required' => '電話番号を入力してください',
            'tel_second.string' => '電話番号を文字列で入力してください',
            'tel_second.max' => '電話番号は5桁までの数字で入力してください',
            'tel_second.regex' => '電話番号は半角数字のみで入力してください',

            'tel_third.required' => '電話番号を入力してください',
            'tel_third.string' => '電話番号を文字列で入力してください',
            'tel_third.max' => '電話番号は5桁までの数字で入力してください',
            'tel_third.regex' => '電話番号は半角数字のみで入力してください',

            'address.required' => '住所を入力してください',
            'address.string' => '住所を文字列で入力してください',
            'address.max' => '住所を255文字以下で入力してください',

            'building.max' => '建物名を255文字以下で入力してください',

            'category_id.required' => 'お問い合わせの種類を選択してください',
            'category_id.integer' => 'お問い合わせの種類を整数で入力してください',

            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.string' => 'お問い合わせ内容を文字列で入力してください',
            'detail.max' => 'お問合せ内容は120文字以内で入力してください',
        ];
    }
}
