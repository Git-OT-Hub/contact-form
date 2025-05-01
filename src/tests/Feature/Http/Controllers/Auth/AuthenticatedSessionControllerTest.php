<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Tests\TestCase;
use App\Models\User;

class AuthenticatedSessionControllerTest extends TestCase
{
    /**
     * @return void
     */
    public function test_非ログイン時は、管理画面にアクセスできない(): void
    {
        $this->get(route('admin.index'))->assertRedirect(route('login'));
    }

    /**
     * @return void
     */
    public function test_ログイン時の入力チェック(): void
    {
        $url = route('login.store');

        // メールアドレスの入力チェック
        $this->post($url, ['email' => ''])->assertInvalid(['email' => 'メールアドレスを入力してください']);
        $this->post($url, ['email' => 123])->assertInvalid(['email' => 'メールアドレスを文字列で入力してください']);
        $this->post($url, ['email' => 'test.example.com'])->assertInvalid(['email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください']);

        // パスワードの入力チェック
        $this->post($url, ['password' => ''])->assertInvalid(['password' => 'パスワードを入力してください']);
        $this->post($url, ['password' => 123])->assertInvalid(['password' => 'パスワードを文字列で入力してください']);
    }

    /**
     * @return void
     */
    public function test_ログイン、ログアウトができる(): void
    {
        // ログインができる
        User::factory()->create(['email' => 'user1@example.com']);

        $this->get(route('login'))->assertOK();

        $validData = [
            'email' => 'user1@example.com',
            'password' => 'password',
        ];

        $this->post(route('login.store'), $validData)->assertRedirect(route('admin.index'));
        $this->get(route('admin.index'))->assertSee('Admin');

        // ログアウトができる
        $this->post(route('logout'))->assertRedirect(route('login'));
    }
}
