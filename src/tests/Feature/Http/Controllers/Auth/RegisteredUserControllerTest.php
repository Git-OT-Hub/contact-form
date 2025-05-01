<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Tests\TestCase;
use App\Models\User;

class RegisteredUserControllerTest extends TestCase
{
    /**
     * @return void
     */
    public function test_ユーザー新規登録時の入力チェック(): void
    {
        $url = route('register.store');
        User::factory()->create(['email' => 'user1@example.com']);

        // 名前の入力チェック
        $this->post($url, ['name' => ''])->assertInvalid(['name' => 'お名前を入力してください']);
        $this->post($url, ['name' => 123])->assertInvalid(['name' => 'お名前を文字列で入力してください']);
        $this->post($url, ['name' => str_repeat('a', 256)])->assertInvalid(['name' => 'お名前を255文字以下で入力してください']);

        // メールアドレスの入力チェック
        $this->post($url, ['email' => ''])->assertInvalid(['email' => 'メールアドレスを入力してください']);
        $this->post($url, ['email' => 123])->assertInvalid(['email' => 'メールアドレスを文字列で入力してください']);
        $this->post($url, ['email' => str_repeat('a', 256)])->assertInvalid(['email' => 'メールアドレスを255文字以下で入力してください']);
        $this->post($url, ['email' => 'test.example.com'])->assertInvalid(['email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください']);
        $this->post($url, ['email' => 'user1@example.com'])->assertInvalid(['email' => 'このメールアドレスは、登録できません']);

        // パスワードの入力チェック
        $this->post($url, ['password' => ''])->assertInvalid(['password' => 'パスワードを入力してください']);
        $this->post($url, ['password' => 123])->assertInvalid(['password' => 'パスワードを文字列で入力してください']);
        $this->post($url, ['password' => str_repeat('a', 256)])->assertInvalid(['password' => 'パスワードを255文字以下で入力してください']);
    }

    /**
     * @return void
     */
    public function test_ユーザー新規登録ができる(): void
    {
        $this->get(route('register'))->assertOK();

        $validData = [
            'name' => 'user1',
            'email' => 'user1@example.com',
            'password' => 'password',
        ];

        $this->post(route('register.store'), $validData)->assertRedirect(route('admin.index'));
        $this->get(route('admin.index'))->assertSee('Admin');

        $registeredUser = [
            'name' => 'user1',
            'email' => 'user1@example.com',
        ];
        $this->assertDatabaseHas('users', $registeredUser);
    }
}
