<?php

namespace Tests\Unit\Services;

use App\Models\Tweet;
use App\Services\TweetService;
use Mockery;
use PHPUnit\Framework\TestCase;
// use Tests\TestCase;

class TweetServiceTest extends TestCase
{
    /**
     * 自分のTweetかどうかをチェックする動作の検証
     * 
     * @runInSeparateProcess
     * @return void
     */
    public function test_is_own_tweet()
    {
        $tweetService = new TweetService();

        $mock = Mockery::mock('alias:App\Models\Tweet');
        // Tweet::where('id', 1)->fist() が呼び出された時の戻り値を指定
        $mock->shouldReceive('where->first')->andReturn((object)[
            'id' => 1,
            'user_id' => 1
        ]);

        // つぶやきのユーザーIDと引数のユーザーIDが一致している場合
        $result = $tweetService->isOwnTweet(1, 1);
        $this->assertTrue($result);

        // つぶやきのユーザーIDと引数のユーザーIDが一致していない場合
        $result = $tweetService->isOwnTweet(2, 1);
        $this->assertFalse($result);
    }
}
