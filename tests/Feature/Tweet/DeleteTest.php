<?php

namespace Tests\Feature\Tweet;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * つぶやき削除成功時の検証
     */
    public function test_delete_successd(): void
    {
        // ユーザーを作成
        $user = User::factory()->create();
        // ユーザーがつぶやきを投稿
        $tweet = Tweet::factory()->create([
            'user_id' => $user->id
        ]);

        // 指定したユーザーでログインした状態にする
        $this->actingAs($user);
        
        $response = $this->delete('/tweet/delete/' . $tweet->id);

        $response->assertRedirect('/tweet');
    }
}
