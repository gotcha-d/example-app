<?php 

namespace App\Services;

use App\Models\Tweet;

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
}

