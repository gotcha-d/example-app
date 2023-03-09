<?php 

namespace App\Services;

use App\Models\Tweet;
use Carbon\Carbon;

class TweetService
{
    public function getTweets()
    {
        $tweets = Tweet::orderBy('created_at', 'DESC')->get();
        return $tweets;
    }

    /**
     * 自分のTweetかどうかをチェックする
     */
    public function isOwnTweet(int $userId, int $tweetId) : bool
    {
        $tweet = Tweet::where('id', $tweetId)->first();
        if (!$tweet) {
            return false;
        }

        return $tweet->user_id === $userId;
    }

    /**
     * 前日のつぶやき数を集計する
     */
    public function countYesterdayTweets()
    {
        $strToday = Carbon::today()->toDateTimeString();
        $strYeasterday = Carbon::yesterday()->toDateTimeString();
        // 年月日の比較には、where ではなく、whereDateを利用
        return Tweet::whereDate('created_at', '>=', $strYeasterday)
            ->whereDate('created_at', '<', $strToday)
            ->count();
    }
}

