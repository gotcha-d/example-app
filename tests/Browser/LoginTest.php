<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * ログイン成功時の動作検証
     */
    public function testSuccessLogin(): void
    {
        $this->browse(function (Browser $browser) {
            // テスト用ユーザーを作成
            $user = User::factory()->create();

            $browser->visit('/login') // ログインページにアクセス
                ->type('email', $user->email) // メールアドレスを入力
                ->type('password', 'password') // パスワードを入力
                ->press('LOG IN') // ログインボタンをクリック
                ->assertPathIs('/tweet') // /tweetに遷移したことを確認
                ->assertSee('つぶやきアプリ');
        });
    }
}
